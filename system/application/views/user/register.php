<?php $this->load->view('main/o_header'); ?>
<?php $this->load->view('main/o_banner'); ?>
<div class="registerPanel">

    <div>
        <!-- left panel -->
        <div class="span-15">
            <div class="banner">
                <h2>create your listing free listing</h2>
                <abbr>We will do our best to help get your property<br /> seen by as many buyers as possible</abbr>
            </div>
        </div>
        <!-- /left panel -->
        <!-- right panel -->
        <div class="span-7">
        </div>
        <!-- /right panel -->
        <div class="clear"></div>		
    </div>
    <div id="registerBox">
        <div class="top">
            <span class="left"><img src="<?php echo base_url() ?>images/register-box-top-left.gif" /></span>
            <span class="right"><img src="<?php echo base_url() ?>images/register-box-top-right.gif" /></span>
        </div>
        <div class="inner">
            <?php echo form_open('register') ?>
            <fieldset>
                <div class="row">
                    <label>Name</label>
                    <input type="text" name="logid" id="logid" value=""  />
                    <div class="tip" id="validateUsername" >Please Enter Your Name</div>
                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Email</label>
                    <input type="text" name="email" id="email" value="" />
                    <div class="tip" id="validateEmail">Please Enter Valid Email</div>
                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Password</label>
                    <input type="password" name="passwordid" id="passwordid" value=""/>
                    <div class="tip" id="validatePassword">Please Enter Password</div>
                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Verify Password</label>
                    <input type="password" name="repassword" id="repassword" value="" />
                    <div class="tip" id="validateRepassword">Please Confirm Password</div>
                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label></label>
                    <span class="left">
                        <input type="checkbox"  class="check" value="agree" name="agree" id="agree" /></span>
                    <div class="terms">I have read and accept the <a href="#" class="blueLink">Terms of Use</a>
                        <span style="color:red;"> <?php echo form_error('agree'); ?></span>
                    </div>
                    <div class="clear"></div><br />

                </div>
                <div class="row">
                    <label></label>
                    <button type="submit" name="register_submit" id="showr"><abbr>Register</abbr></button>
                </div>

            </fieldset>
            </form>			
        </div>	
        <div class="bottom"><span class="left"><img src="<?php echo base_url() ?>images/register-box-bottom-left.gif" /></span><span class="right"><img src="<?php echo base_url() ?>images/register-box-bottom-right.gif" /></span></div>	

    </div>

    <div id="registerBoxRight">
        <div class="top">
            <span class="left"><img src="<?php echo base_url() ?>images/register-box-top-left.gif" /></span>
            <span class="right"><img src="<?php echo base_url() ?>images/register-box-top-right.gif" /></span>.
        </div>
        <div class="inner">


        </div>	
        <div class="bottom"><span class="left"><img src="<?php echo base_url() ?>images/register-box-bottom-left.gif" /></span><span class="right"><img src="<?php echo base_url() ?>images/register-box-bottom-right.gif" /></span></div>	

    </div>

    <div class="clear"></div>
</div>	
<!--===== /content panel =====-->

<div class="clear"></div>	
</div>
<!-- /container -->

<?php $this->load->view('main/o_footer'); ?>