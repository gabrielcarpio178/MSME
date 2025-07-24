<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="icon" type="image/svg+xml" href="images/city_of_bago_logo_icon.png" />
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/contact.css">
    <title>Contact</title>
</head>
<body>
    <?php include 'subpages/header.php' ?>
    <div class="content d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex flex-row w-100 gap-2">
            <div class="w-25 contact-us d-flex flex-column gap-2">
                <div class="card p-2">
                    <div class="d-flex flex-row align-items-center gap-1">
                        <div class="icon d-flex flex-column align-items-center justify-content-center bg-success">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h5>Call To Us</h5>
                    </div>
                    <p class="mt-2">We are available 24/7 days a week.</p>
                    <div>
                        Phone: <span>+639123456789</span>
                    </div>
                </div>
                <div class="card p-2">
                    <div class="d-flex flex-row align-items-center gap-1">
                        <div class="icon d-flex flex-column align-items-center justify-content-center bg-success">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5>Write To Us</h5>
                    </div>
                    <p class="mt-2">
                        Fill out form and we will contact you within 24 hours
                    </p>
                    <div>
                        Email: <span>Customer@exclusive.con</span>
                    </div>
                    <div>
                        Email: <span>Support@exclusive.con</span>
                    </div>
                </div>
            </div>
            <div class="w-75 d-flex flex-column card">
                <form class="row row-cols-3 p-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your name">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Your Email">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="phone">Your Phone</label>
                            <input type="number" name="phone" class="form-control" id="phone" placeholder="Your Phone">
                        </div>
                    </div>
                    <div class="col-3 w-100">
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea name="message" class="form-control" id="message" placeholder="Your Message" style="height: 160px;"></textarea>
                        </div>
                    </div>
                    <div class="col-3 w-100 mt-2 d-flex justify-content-end">
                        <button class="btn btn-success w-25" type="submit">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include "subpages/footer.php" ?>
</body>
</html>