<?php

namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Respect\Validation\Validator;

class HomeController extends Controller
{
    public function getIndex(): void
    {
        $categories = Category::select(['slug', 'title'])->get();
        $products = Product::with('product_photo')->select(['id', 'title', 'price', 'slug'])->where('active', 1)->get();

        view('home', ['categories' => $categories, 'products' => $products]);
    }

    public function getRegister(): void
    {
        $categories = Category::select(['slug', 'title'])->get();

        view('register', ['categories' => $categories]);
    }

    public function postRegister(): void
    {
        $validator = new Validator();
        $errors = [];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $profile_photo = $_FILES['profile_photo'];

        // validation
        if ($validator::alnum()->noWhitespace()->validate($username) === false) {
            $errors['username'] = 'Username can only contain alphabets or numeric';
        }
        if (\strlen($username) < 6) {
            $errors['username'] = 'Username must have at least 6 chars';
        }
        if ($validator::email()->validate($email) === false) {
            $errors['email'] = 'Email must be a valid email address';
        }
        if (\strlen($password) < 6) {
            $errors['password'] = 'Password must have at least 6 chars';
        }
        if ($validator::image()->validate($profile_photo['name'])) {
            $errors['profile_photo'] = 'Profile photo must be an image file';
        }

        if (empty($errors)) {
            // process file upload
            $file_name = 'profile_photo_'.time();
            $extension = explode('.', $profile_photo['name']);
            $ext = end($extension);
            move_uploaded_file($profile_photo['tmp_name'], 'media/profile_photo/'.$file_name.'.'.$ext);
            $token = sha1($username.$email.uniqid('llc', true));

            User::create([
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'profile_photo' => $file_name.'.'.$ext,
                'email_verification_token' => $token,
            ]);

            // send the email
            $mail = new PHPMailer(true);                      // Passing `true` enables exceptions
            try {
                // Server settings
                $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'af2a20736cc551';                 // SMTP username
                $mail->Password = 'c617b024b04e5e';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 2525;                                 // TCP port to connect to
                //Recipients
                $mail->setFrom('smseleem@gmail.com', 'System User');
                $mail->addAddress($email, $username);
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Registration successful';
                $mail->Body = 'Dear '.$username.', <br/>
            Please click the following link to activate your account<br/>
            <a href="http://llc04-ecommerce.sumon/activate/'.$token.'">Click Here to Activate</a>
            <br/>- LLC Team';
                $mail->send();
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }

            $_SESSION['success'] = 'User registration successful!';
            header('Location: /login');
            exit();
        }

        $_SESSION['errors'] = $errors;
        header('Location: /register');
        exit();
    }

    public function getLogin(): void
    {
        $categories = Category::select(['slug', 'title'])->get();

        view('login', ['categories' => $categories]);
    }

    public function postLogin(): void
    {
        $validator = new Validator();
        $errors = [];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // validation
        if ($validator::email()->validate($email) === false) {
            $errors['email'] = 'Email must be a valid email address';
        }

        if (\strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 chars';
        }

        if (empty($errors)) {
            $user = User::select(['id', 'password', 'email', 'username', 'email_verified_at'])->where('email', $email)->first();

            if ($user) {
                if ($user->email_verified_at === null) {
                    $errors[] = 'Your account is not verified';
                    $_SESSION['errors'] = $errors;
                    header('Location: /login');
                    exit();
                }

                if (password_verify($password, $user->password) === true) {
                    $_SESSION['success'] = 'Logged in.';
                    $_SESSION['user'] = [
                        'id' => $user->id,
                        'email' => $user->email,
                        'username' => $user->username,
                    ];
                    header('Location: /dashboard');
                    exit();
                }

                $errors[] = 'Invalid credentials';
                $_SESSION['errors'] = $errors;
                header('Location: /login');
                exit();
            }

            $errors[] = 'User not found';
            $_SESSION['errors'] = $errors;
            header('Location: /login');
            exit();
        }
    }

    public function getActivate($token = ''): void
    {
        $errors = [];

        if (empty($token)) {
            $errors[] = 'No token provided';
            $_SESSION['errors'] = $errors;
            header('Location: /login');
            exit();
        }

        $user = User::where('email_verification_token', $token)->first();

        if ($user) {
            $user->update([
                'email_verified_at' => Carbon::now(),
                'email_verification_token' => null,
            ]);

            $_SESSION['success'] = 'Account activated. You can login now.';
            header('Location: /login');
            exit();
        }

        $errors[] = 'Invalid token provided';
        $_SESSION['errors'] = $errors;
        header('Location: /login');
        exit();
    }

    public function getLogout(): void
    {
        unset($_SESSION['user']);

        $_SESSION['success'] = 'You have been logged out.';
        header('Location: /login');
        exit();
    }

    public function getProduct($slug = null)
    {
        if ($slug === null) {
            redirect('/');
        }

        $categories = Category::select(['slug', 'title'])->get();
        $product = Product::where('slug', $slug)->first();

        view('product', ['product' => $product, 'categories' => $categories]);
    }
}
