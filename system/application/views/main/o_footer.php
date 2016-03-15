<!-- footer -->
<div class="footer">
    <div class="inner">
        <ul>
            <li><abbr><a href="#">SIGN UP</a></abbr></li>
            <li><abbr><a href="#">terms &amp; Conditions</a></abbr></li>
            <li><abbr><a href="#">Privacy Policy</a></abbr></li>
            <li><abbr><a href="#">Send Us Feedback</a></abbr></li>
            <li><abbr><a href="#">Another Link</a></abbr></li>
        </ul>
        <div class="copyright">Copyright Your Company, 2009. All Rights Reserved</div>
        <div class="clear"></div>	
    </div>
</div>
<!-- /footer -->


<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.js"></script>
<?php
if ($page_extrs_js != '') {
    $this->load->view('extrajs/' . $page_extrs_js);
}
?>
<script type="text/javascript" src="<?php echo base_url() ?>js/ddsmoothmenu.js"></script>
<script type="text/javascript">
    ddsmoothmenu.init({
        mainmenuid: "smoothmenu1", //menu DIV id
        orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
        classname: 'ddsmoothmenu', //class added to menu's outer DIV
        //customtheme: ["#1c5a80", "#18374a"],
        contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
    })
    ddsmoothmenu.init({
        mainmenuid: "smoothmenu2", //Menu DIV id
        orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
        classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
        //customtheme: ["#804000", "#482400"],
        contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
    })
    function loginShow() {
        if (document.getElementById("loginBox").style.display == "none")
        {
            document.getElementById("login").setAttribute("className", "LastSel")
            document.getElementById("login").setAttribute("class", "LastSel")
            document.getElementById("loginBox").style.display = "block";
        }
        else {
            document.getElementById("login").setAttribute("className", "Last")
            document.getElementById("login").setAttribute("class", "Last")
            document.getElementById("loginBox").style.display = "none";
        }
    }
</script>	
<script type="text/javascript" src="<?php echo base_url() ?>js/browser-select.js"></script>


<!-- jquery.Slideshow file -->
<script type="text/javascript" src="<?php echo base_url() ?>js/banner/jquery.slideshow.js"></script>


<!-- Javascripts for examples, can be deleted -->
<script type="text/javascript">
    $(document).ready(function () {
        // simplest example
        $('.simpleSlideShow, .slideShowTopNavi').slideShow({
            interval: 3
        });
        // slideshow with mouse hover
        $('.useMouseSlideShow').slideShow({
            hoverNavigation: true,
            interval: false
        });
        // slideshow with images
        $('.imageNavigation').slideShow({
            interval: 3
        });
        // random slideshow
        $('.randomSlideShow').slideShow({
            interval: 3,
            start: 'random'
        });

        // slideshow with play/pause
        var slideShow = $('.playPauseExample').slideShow({
            interval: 0.7
        });
        // now add logic to play/pause button
        $('.playPauseExample a.togglePlayback').click(function () {
            if (slideShow.isPlaying()) {
                $(this).html('play');
            } else {
                $(this).html('stop');
            }
            slideShow.togglePlayback();
        });
        // slideshow with callback
        $('.callbackSlideShow').slideShow({
            interval: 3,
            slideClick: function (slideShow) {
                if (slideShow.mouse.x > slideShow.options.slideSize.width / 2) {
                    slideShow.next();
                } else {
                    slideShow.previous();
                }
            },
            gotoSlide: function (slideShow, index) {
                $('.callBackSlideShowLog').html('goto slide index: ' + index);
            }
        });
    });
</script>
</body>
</html>