<template>
    <!--PRELOADER-->
    <section id="jSplash">
        <div id="circle"></div>
    </section>
    <div id="menutop"></div>

    <!--Wrapper
    =============================-->
    <div id="wrapper">
        <div id="mask">

            <!--Header
        =============================-->
            <div id="header" class="header">
                <div class="menu-inner">
                    <div class="container"><div class="row">
                        <div class="header-table col-md-12 header-menu">
                            <!--  Logo section -->
                            <div class="brand"><a href="./"  class="nav-link"><img src="/img/RestaurantMenu/logo-belle-vue-big-blanco-300x101.png"></a></div>
                            <!--  // Logo section -->
                        </div>
                    </div></div>
                </div>
            </div>
            <!-- // Header
            =============================-->

            <!--Home Page
            =============================-->
            <div id="home" class="item">
                <img src="/img/2.jpg" alt="The Spice Lounge" class="fullBg">
                <div class="content">

                    <div class="content_overlay"></div>
                    <div class="content_inner">
                        <div class="row contentscroll">
                            <div class="container col-md-12">
                                <div class="col-md-12 empty">&nbsp;</div>
                                <div class="col-md-12 content_text">
                                    <div class="clearfix">
                                        <div class="main">
                                            <div class="clearfix">
                                                <!-- div one created -->
                                                <Section v-for="section in menu.menusections" :section="section"/>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- // Home Page
            =============================-->

            <!--Ads
            =============================-->

            <!-- <div id="bv-ad"><img src="/img/test-ad.gif"></div> -->

            <!-- // Ads
            =============================-->
        </div>
    </div>
    <!-- // Wrapper =============================-->
</template>

<script>
import 'Pub/css/RestaurantMenu/ads.css'
import 'Pub/css/RestaurantMenu/animate.min.css'
import 'Pub/css/RestaurantMenu/bootstrap.css'
import 'Pub/css/RestaurantMenu/bootstrap-datetimepicker.min.css'
import 'Pub/css/RestaurantMenu/component.css'
import 'Pub/css/RestaurantMenu/font-awesome.css'
import 'Pub/css/RestaurantMenu/slicknav.css'
import 'Pub/css/RestaurantMenu/menu.css'
import 'Pub/css/RestaurantMenu/style.css'
import 'Pub/css/RestaurantMenu/custom.css'
import 'Pub/css/RestaurantMenu/color1.css'
import Section from '@/Pages/RestaurantMenu/Front/Section'


export default {
    name: 'Index',
    props: {
        menu: Object,
    },
    components: {
        Section,
    },
    mounted() {
        let headScripts = [
            '/js/RestaurantMenu/jquery-1.11.1.min.js',
        ]
        let bodyScripts = [
            '/js/RestaurantMenu/jquery-migrate-1.2.1.js',
            '/js/RestaurantMenu/jquery-ui.min.js',
            '/js/RestaurantMenu/modernizr.custom.js',
            '/js/RestaurantMenu/bootstrap.min.js',
            '/js/RestaurantMenu/jquery.validate.min.js',
            '/js/RestaurantMenu/bootstrap-datetimepicker.min.js',
            '/js/RestaurantMenu/jquery.scrollTo.min.js',
            '/js/RestaurantMenu/jquery.fitvids.js',
            '/js/RestaurantMenu/jquery.slicknav.min.js',
            '/js/RestaurantMenu/jquery.nicescroll.min.js',
            '/js/RestaurantMenu/jquery.easing.1.3.js',
            '/js/RestaurantMenu/retina-1.1.0.min.js',
            '/js/RestaurantMenu/jpreloader.min.js',
            '/js/RestaurantMenu/jquery.prettyPhoto.js',
            '/js/RestaurantMenu/jquery.mixitup.min.js',
            '/js/RestaurantMenu/wait.js',
            '/js/RestaurantMenu/custom_general.js',
            '/js/RestaurantMenu/jquery.history.js',
        ]
        headScripts.forEach(function(value){
            let externalScript = document.createElement('script')
            externalScript.setAttribute('src', value)
            document.head.appendChild(externalScript)
        })
        bodyScripts.forEach(function(value){
            let externalScript = document.createElement('script')
            externalScript.setAttribute('src', value)
            document.body.appendChild(externalScript)
        })
    }
}
</script>

<style scoped>

</style>
