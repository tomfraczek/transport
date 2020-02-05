<?php
/**
 * PHPMailer simple contact form example.
 * If you want to accept and send uploads in your form, look at the send_file_upload example.
 */

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

require './vendor/autoload.php';

if (array_key_exists('to', $_POST)) {
    $err = false;
    $msg = '';
    $email = '';
    //Apply some basic validation and filtering to the subject
    if (array_key_exists('subject', $_POST)) {
        $subject = substr(strip_tags($_POST['subject']), 0, 255);
    } else {
        $subject = 'No subject given';
    }
    //Apply some basic validation and filtering to the query
    if (array_key_exists('query', $_POST)) {
        //Limit length and strip HTML tags
        $query = substr(strip_tags($_POST['query']), 0, 16384);
    } else {
        $query = '';
        $msg = 'No query provided!';
        $err = true;
    }
    //Apply some basic validation and filtering to the name
    if (array_key_exists('name', $_POST)) {
        //Limit length and strip HTML tags
        $name = substr(strip_tags($_POST['name']), 0, 255);
    } else {
        $name = '';
    }
    //Validate to address
    //Never allow arbitrary input for the 'to' address as it will turn your form into a spam gateway!
    //Substitute appropriate addresses from your own domain, or simply use a single, fixed address
//    if (array_key_exists('to', $_POST) && in_array($_POST['to'], ['sales', 'support', 'accounts'], true)) {
//        $to = $_POST['to'] . '@example.com';
//    } else {
//        $to = 'tomaszfr90@gmail.com';
//    }
    $to = 'tomaszfr90@gmail.com';
    //Make sure the address they provided is valid before trying to use it
    if (array_key_exists('email', $_POST) && PHPMailer::validateAddress($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $msg .= 'Error: invalid email address provided';
        $err = true;
    }
    if (!$err) {
        $mail = new PHPMailer;
//        $mail->isSMTP();
$mail->Host = 'localhost';
$mail->Port = 25;
$mail->CharSet = PHPMailer::CHARSET_UTF8;
//It's important not to use the submitter's address as the from address as it's forgery,
//which will cause your messages to fail SPF checks.
//Use an address in your own domain as the from address, put the submitter's address in a reply-to
$mail->setFrom('contact@example.com', (empty($name) ? 'Contact form' : $name));
$mail->addAddress($to);
$mail->addReplyTo($email, $name);
$mail->Subject = 'Contact form: ' . $subject;
$mail->Body = "Contact form submission\n\n" . $query;
if (!$mail->send()) {
$msg .= 'Mailer Error: '. $mail->ErrorInfo;
} else {
$msg .= 'Message sent!';
}
}
} ?>

<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Smorawski Transport Partnership</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="utility/uikit/uikit.min.css">
    <link rel="stylesheet" href="styles/styles.css">
    <script src="utility/uikit/uikit.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>
    <script src="js/leaflet-map.js"></script>

</head>
<body>

<header>
    <div class="container">
        <nav>
            <div class="nav-logo">
                <img src="./img/truck.svg" alt="">
                <span>Smorawsky Empire</span>
            </div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>

<section class="slideshow--main">

    <div class="container">
        <div class="slideshow-fix--top">
            <img src="./img/phone.svg" alt="">
            <p>call us: 123 456 789</p>
        </div>
    </div>

    <div class="uk-position-relative uk-visible-toggle uk-light main-slider" tabindex="-1" uk-slideshow="autoplay: true; finite: false; autoplay-interval: 6000; pause-on-hover: false; ratio: 7:3">

        <ul class="uk-slideshow-items slideshow-items">
            <li>
                <img src="img/slide1.jpg" alt="" uk-cover>
            </li>
            <li>
                <img src="img/slide2.jpg" alt="" uk-cover>
            </li>
            <li>
                <img src="img/slide3.jpg" alt="" uk-cover>
            </li>
        </ul>

    </div>

    <img class="mobile-top-img" src="img/slide1.png" alt="">

    <div class="container">
        <div class="slideshaw-fix--bottom">
            <div class="slideshow--bottom__top">
                <h2>STUNNING 6 BED HOUSE IN THE HEART OF THE CITY</h2>
                <p>I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font.</p>
            </div>

            <div class="slideshow--bottom__bottom">
                <h2>$2,000,000</h2>
                <a href="#">all sales</a>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <section id="sectionTwo" class="section-two">
        <h2>LATEST PROPERTIES FOR SALE</h2>

        <div class="three-cards">
            <div class="card card-one">
                <a href="#">
                    <img src="./img/montains.jpg" alt="">
                </a>

                <h3 class="header-small">DOWN AVENUE</h3>
                <p class="card-price">$500,000</p>
                <p class="card-rooms">4 Bedrooms</p>
                <p class="card-paragraph">I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. I’m a great place for you to tell a story and let your users know a little more about you.</p>
                <a href="#" class="card-read-more">read more</a>
            </div>

            <div class="card card-two">
                <a href="#">
                    <img src="./img/column2.jpg" alt="">
                </a>

                <h3 class="header-small">QUEENS WAY</h3>
                <p class="card-price">$450,000</p>
                <p class="card-rooms">3 Bedrooms</p>
                <p class="card-paragraph">I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. I’m a great place for you to tell a story and let your users know a little more about you.</p>
                <a href="#" class="card-read-more">read more</a>
            </div>

            <div class="card card-three">
                <a href="#">
                    <img src="./img/column3.jpg" alt="">
                </a>

                <h3 class="header-small">RANDALL CLOSE</h3>
                <p class="card-price">$790,000</p>
                <p class="card-rooms">6 Bedrooms</p>
                <p class="card-paragraph">I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. I’m a great place for you to tell a story and let your users know a little more about you.</p>
                <a href="#" class="card-read-more">read more</a>
            </div>
        </div>
    </section>
</div>

<section id="sectionThree" class="section-three">
    <h2>LATEST PROPERTIES PROPERTIES</h2>

    <div class="section-three--top section-three--content">
        <img src="./img/envelope.jpg" alt="">

        <div class="three--top__right card">
            <h3 class="header-small">QUEENS WAY</h3>
            <p class="card-rooms">3 Bedrooms</p>
            <p class="card-paragraph">I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. I’m a great place for you to tell a story and let your users know a little more about you.</p>
            <p class="card-price">$450,000</p>
        </div>
    </div>

    <div class="section-three--bottom section-three--content">
        <div class="three--bottom__left card">
            <h3 class="header-small">QUEENS WAY</h3>
            <p class="card-rooms">3 Bedrooms</p>
            <p class="card-paragraph">I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. I’m a great place for you to tell a story and let your users know a little more about you.</p>
            <p class="card-price">$450,000</p>
        </div>
        <img src="./img/forest.jpg" alt="">
    </div>

</section>

<div class="container">
    <section id="sectionFour" class="section-four">
        <h2>REALTORS YOU CAN TRUST</h2>

        <div class="four--cards__wrapper">
            <div class="four--card">
                <img src="./img/four-icon.png" alt="">
                <h3>FREE REGISTRATION<br>NO HIDDEN FEES</h3>
                <p>I'm a paragraph. Click here to add your own text and edit me. Let your users get to know you.</p>
            </div>

            <div class="four--card">
                <img src="./img/four-icon.png" alt="">
                <h3>FREE REGISTRATION<br>NO HIDDEN FEES</h3>
                <p>I'm a paragraph. Click here to add your own text and edit me. Let your users get to know you.</p>
            </div>

            <div class="four--card">
                <img src="./img/four-icon.png" alt="">
                <h3>FREE REGISTRATION<br>NO HIDDEN FEES</h3>
                <p>I'm a paragraph. Click here to add your own text and edit me. Let your users get to know you.</p>
            </div>
        </div>

    </section>
</div>

<section id="sectionFive" class="section-five">
    <div class="parallax-slide">
        <div class="parallax-clip">
            <div class="fixed-parallax section-five--content" style="background-image: url(./img/bcg-pic.jpg);">

                <div class="bcg--white-cover">

                    <div class="container">

                        <h2>WHAT OUR CLIENTS THINK</h2>

                        <div class="three-quotes--wrapper">

                            <div class="quote">
                                <svg preserveAspectRatio="xMidYMid meet" data-bbox="8.8 9.7 81 81.3" xmlns="http://www.w3.org/2000/svg" viewBox="8.8 9.7 81 81.3" role="img">
                                    <g>
                                        <path d="M8.8 91V59.9c0-27.7 10-44 31.8-50.2v17c-10.4 4.5-14.5 13.8-14.2 30.8h14.2V91H8.8z"></path>
                                        <path d="M58 91V59.9c0-27.7 10-44 31.8-50.2v17c-10.4 4.5-14.5 13.8-14.2 30.8h14.2V91H58z"></path>
                                    </g>
                                </svg>

                                <p class="quote-paragraph">"I'm a testimonial. Click to edit me and add text that says something nice about you and your services"</p>

                                <h3 class="quote-bottom">-Tina & James Heart</h3>
                            </div>

                            <div class="quote">
                                <svg preserveAspectRatio="xMidYMid meet" data-bbox="8.8 9.7 81 81.3" xmlns="http://www.w3.org/2000/svg" viewBox="8.8 9.7 81 81.3" role="img">
                                    <g>
                                        <path d="M8.8 91V59.9c0-27.7 10-44 31.8-50.2v17c-10.4 4.5-14.5 13.8-14.2 30.8h14.2V91H8.8z"></path>
                                        <path d="M58 91V59.9c0-27.7 10-44 31.8-50.2v17c-10.4 4.5-14.5 13.8-14.2 30.8h14.2V91H58z"></path>
                                    </g>
                                </svg>

                                <p class="quote-paragraph">"I'm a testimonial. Click to edit me and add text that says something nice about you and your services"</p>

                                <h3 class="quote-bottom">-Tina & James Heart</h3>
                            </div>

                            <div class="quote">
                                <svg preserveAspectRatio="xMidYMid meet" data-bbox="8.8 9.7 81 81.3" xmlns="http://www.w3.org/2000/svg" viewBox="8.8 9.7 81 81.3" role="img">
                                    <g>
                                        <path d="M8.8 91V59.9c0-27.7 10-44 31.8-50.2v17c-10.4 4.5-14.5 13.8-14.2 30.8h14.2V91H8.8z"></path>
                                        <path d="M58 91V59.9c0-27.7 10-44 31.8-50.2v17c-10.4 4.5-14.5 13.8-14.2 30.8h14.2V91H58z"></path>
                                    </g>
                                </svg>

                                <p class="quote-paragraph">"I'm a testimonial. Click to edit me and add text that says something nice about you and your services"</p>

                                <h3 class="quote-bottom">-Tina & James Heart</h3>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<div class="container">
    <section id="sectionSix" class="section-six">
        <h2>CONTACT US</h2>

        <div class="contact-top">
            <div class="section-six--left">

                <div class="left--address">
                    <h3>ADDRESS</h3>
                    <p>500 Terry Francois Street<br>San Francisco, CA 94158</p>
                </div>

                <div id="map"></div>
            </div>

            <div class="section-six--right">
                <h3>ALTERNATIVELY YOU CAN FILL<br>IN THE FOLLOWING CONTACT<br>FORM:</h3>

                <?php if (empty($msg)) { ?>
                <form method="post">
                    <label for="to">Send to:</label>
                    <select name="to" id="to">
                        <option value="sales">Sales</option>
                        <option value="support" selected="selected">Support</option>
                        <option value="accounts">Accounts</option>
                    </select><br>
                    <label for="subject">Subject: <input type="text" name="subject" id="subject" maxlength="255"></label><br>
                    <label for="name">Your name: <input type="text" name="name" id="name" maxlength="255"></label><br>
                    <label for="email">Your email address: <input type="email" name="email" id="email" maxlength="255"></label><br>
                    <label for="query">Your question:</label><br>
                    <textarea cols="30" rows="8" name="query" id="query" placeholder="Your question"></textarea><br>
                    <input type="submit" value="Submit">
                </form>

                <?php } else {
                    echo $msg;
                } ?>

            </div>
        </div>

        <div class="contact-bottom">
            <h3>TO SPEAK WITH AN AGENT, PLEASE CALL OR EMAIL US:</h3>

            <p>Email: info@mysite.com<br>Tel: 123-456-7890<br>Fax: 123-456-7890</p>
        </div>


    </section>
</div>

<footer>

</footer>

</body>
</html>