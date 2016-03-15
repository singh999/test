<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <base href="<?php echo base_url() ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php echo $page_title ?></title>

        <!-- framework BluePrint -->
        <link rel="stylesheet" href="<?php echo base_url() ?>css/blueprint/screen.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/blueprint/print.css" type="text/css" media="print" />
        <!--[if lt IE 8]><link rel="stylesheet" href="<?php echo base_url() ?>css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
        <!-- /framework BluePrint -->
        <link rel="stylesheet" href="<?php echo base_url() ?>css/style.css" type="text/css" media="screen, projection" />
        <!-- dropdown -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/ddsmoothmenu.css" />
        <script src="<?php echo base_url() ?>js/cufon-yui.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/nevis_700.font.js"></script>
        <script type="text/javascript">
            Cufon.replace('abbr');
            Cufon.replace('h1');
            Cufon.replace('h2');
        </script>
    </head>

    <body id="registerPage">
        <!-- container -->
        <div class="container showgrid">

            <!--===== header =====-->
            <div class="span-8">
                <a href="index.html" class="logo"></a>
            </div>
            <div class="span-18 last navigation">
                <?php $this->load->view('main/o_navigation'); ?>
                <?php echo form_open('auth/login') ?>
                <div id="loginBox" style="display:none;">
                    <fieldset>
                        <div class="row">
                            <label>Email</label>
                            <input type="text" name="email" />
                            <div class="clear"></div>
                        </div>
                        <div class="row">
                            <label>Password</label>
                            <input type="password" name="password" />
                            <div class="clear"></div>
                        </div>
                        <div class="row">
                            <label></label>
                            <button type="submit" name="submit">Submit</button>
                            <?php echo anchor('register/forget', 'Forgot Password?', 'class="forgot"'); ?>
                            <div class="clear"></div>
                        </div>
                        <div class="row-1">
                            <input type="checkbox" /><a href="#" class="remember">Remember Me</a>
                        </div>
                    </fieldset>
                    <div class="clear"></div>
                </div>
                </form>
                <div class="clear"></div>
            </div>



            <div class="clear"></div>
            <!--===== /header =====-->