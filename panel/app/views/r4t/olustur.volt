{{content()}}
{{ form("r4t/olustur") }}

    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("r4t", "&larr; Vazgeç") }}
        </li>
        <li class="pull-right">
            {{ submit_button("Oluştur", "class": "btn btn-success") }}
        </li>
    </ul>

    <fieldset>

    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
            {{ element }}
        {% else %}
        {% if is_a(element, 'Phalcon\Forms\Element\Check') %}
        <div class="checkbox">

                {{ element.render(['data-toggle':'toggle']) }}
                {{ element.label() }}
            </div>
        {% else %}
            <div class="form-group">
                {{ element.label() }}
                {{ element.render(['class': 'form-control']) }}
                        
            </div>{% endif %}
        {% endif %}
    {% endfor %}

    </fieldset>

</form>