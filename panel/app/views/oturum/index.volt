{{ content() }}
<div class="row">

    <div class="col-md-6">
        <div class="page-header">
            <h2><?=$t->_('login_header');?></h2>
        </div>
        {{ form('oturum/baslat', 'role': 'form') }}
            <fieldset>
                <div class="form-group">
                    <label for="email"><?=$t->_('email_label');?></label>
                    <div class="controls">
                        {{ text_field('email', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="password"><?=$t->_('password_label');?></label>
                    <div class="controls">
                        {{ password_field('password', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    {{ submit_button(t._("login_button"), 'class': 'btn btn-primary btn-large') }}
                </div>
            </fieldset>
        </form>
    </div>

    <div class="col-md-6">

        <div class="page-header">
            <h2><?=$t->_('register_header');?></h2>
        </div>

        <p><?=$t->_('register_notice');?></p>


        <div class="clearfix center">
            {{ link_to('kayit', t._("register_button") , 'class': 'btn btn-primary btn-large btn-success') }}
        </div>
    </div>

</div>
