<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Home-Webgis</title>

        <!-- CSS FILES -->        
        <?= $this->include('templates/header'); ?>
<!--

TemplateMo 583 Festava Live

https://templatemo.com/tm-583-festava-live

-->
    </head>
    
    <body>

        <main class="vh-100" >

            <?= $this->include('templates/navbar'); ?>
            

            <section class="hero-section" id="section_1">
                <div class="section-overlay"></div>

                <div class="container d-flex justify-content-center align-items-center">
                    <div class="row">

                        <div class="col-12 mt-auto mb-5 text-center">
                            <small>Mufadha Tiohandra's present</small>

                            <h1 class="text-white mb-5">APP GIS 2024</h1>

                        </div>

                        
                    </div>
                </div>

                <div class="video-wrap">
                    <video autoplay="" loop="" muted="" class="custom-video" poster="">
                        <source src="<?=base_url() ?>template/dist/video/video.mp4" type="video/mp4">

                        Your browser does not support the video tag.
                    </video>
                </div>
            </section>

        </main>


        <?= $this->include('templates/footer'); ?>

<!--

T e m p l a t e M o

-->

        <!-- JAVASCRIPT FILES -->
        <!-- <script src="<?=base_url() ?>template/dist/js/jquery.min.js"></script>
        <script src="<?=base_url() ?>template/dist/js/bootstrap.min.js"></script>
        <script src="<?=base_url() ?>template/dist/js/jquery.sticky.js"></script>
        <script src="<?=base_url() ?>template/dist/js/click-scroll.js"></script>
        <script src="<?=base_url() ?>template/dist/js/custom.js"></script> -->

    </body>
</html>