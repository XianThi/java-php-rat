
{{ content() }}

<div class="page-header">
    <h2><?=$t->_('contact_header');?></h2>
</div>

<p><?=$t->_('contact_desc');?></p>

{{ form('iletisim/send', 'role': 'form') }}
    <fieldset>
        <div class="form-group">
            {{ form.label('name') }}
            {{ form.render('name', ['class': 'form-control']) }}
        </div>
        <div class="form-group">
            {{ form.label('email') }}
            {{ form.render('email', ['class': 'form-control']) }}
        </div>
        <div class="form-group">
            {{ form.label('comments') }}
            {{ form.render('comments', ['class': 'form-control']) }}
        </div>
        <div class="form-group">
            {{ submit_button('Gönder', 'class': 'btn btn-primary btn-large') }}
        </div>
    </fieldset>
</form>
