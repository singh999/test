<?php $this->load->view('main/o_header'); ?>
<?php $this->load->view('main/o_banner'); ?>
<!--===== content panel =====-->
<div class="registerPanel">
    <div>
        <!-- left panel -->
        <div class="span-15">
            <div class="banner">
                <h2>Already Registered ? Login here</h2>
                <abbr>Please fill in your username and password below to login</abbr>
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
        <?php echo form_open('auth/login') ?>
        <div class="inner">
            <fieldset>
                <div class="row">
                    <label>Email</label>
                    <input type="text" name="email" id="email"  />
                    <?php if ($error != '') {
                        echo '<div class="wrong">' . $error . '</div>';
                    } ?>
<?php echo form_error('email', '<div class="wrong">', '</div>'); ?>
                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Password</label>
                    <input type="password" name="password" id="password"  />
<?php echo form_error('password', '<div class="wrong">', '</div>'); ?>
                    <div class="clear"></div>	
                </div>
                <div class="row">
                    <label></label>
                    <button type="submit" name="register_submit" id="register_submit"><abbr>Login</abbr></button>
                </div>
            </fieldset>
            </form>			
        </div>	
        </form>
        <div class="bottom"><span class="left"><img src="<?php echo base_url() ?>images/register-box-bottom-left.gif" /></span><span class="right"><img src="<?php echo base_url() ?>images/register-box-bottom-right.gif" /></span></div>	
    </div>
    <div class="clear"></div>
</div>	
<!--===== /content panel =====-->
<div class="clear"></div>	
</div>

<?php $this->load->view('main/o_footer'); ?>