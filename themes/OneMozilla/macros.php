{# This Source Code Form is subject to the terms of the Mozilla Public
 # License, v. 2.0. If a copy of the MPL was not distributed with this
 # file, You can obtain one at http://mozilla.org/MPL/2.0/. #}

{% macro email_newsletter_form(newsletter_id='mozilla-and-you', title=None, include_country=True, include_language=True, footer=True) %}
  {% if not request.newsletter_success %}
    {% if request.newsletter_form.errors %}
      <div id="footer-email-errors">
        {{ request.newsletter_form.non_field_errors()|safe }}

        <ul class="errorlist">
            {% if request.newsletter_form.email.errors %}
                <li>{{ _('Please enter a valid email address') }}</li>
            {% endif %}

            {% if request.newsletter_form.lang.errors %}
                <li>{{ request.newsletter_form.lang.errors }}</li>
            {% endif %}

            {% if request.newsletter_form.newsletter.errors %}
                <li>{{ request.newsletter_form.newsletter.errors }}</li>
            {% endif %}

            {% if request.newsletter_form.privacy.errors %}
                <li>{{ _('You must agree to the privacy policy') }}</li>
            {% endif %}
        </ul>
      </div>
    {% endif %}

    <form class="billboard newsletter-form{% if request.newsletter_form.errors %} has-errors{% endif %}"
          {% if footer %}
             id="footer-email-form" action="{{ secure_url() }}#footer-email-form"
          {% else %}
              id="newsletter-form" action="{{ secure_url() }}"
          {% endif %}
          method="post">
      {% if footer %}
        <input type="hidden" name="newsletter-footer" value="Y">
      {% endif %}
      <input type="hidden" name="newsletter" value="{{ newsletter_id }}">
      <input type="hidden" name="source_url" value="{{ request.build_absolute_uri() }}">

      {% if footer %}
        <h3>{{ title|d(_('Get Firefox news'), true) }}</h3>
      {% endif %}

      <div class="form-contents">
        <div class="field field-email {% if request.newsletter_form.email.errors %}form-field-error{% endif %}">
          {{ field_with_attrs(request.newsletter_form.email, placeholder=_('YOUR EMAIL HERE'))|safe }}
        </div>

        <div id="form-details">
          {% if include_country %}
            <div class="field field-country">
              {{ request.newsletter_form.country|safe }}
            </div>
          {% endif %}
          {% if include_language %}
            <div class="field field-language {% if request.newsletter_form.lang.errors %}form-field-error{% endif %}">
              {{ request.newsletter_form.lang|safe }}
            </div>
          {% endif %}
          <div class="field field-format">
            {{ request.newsletter_form.fmt|safe }}
          </div>
          <div class="field field-privacy {% if request.newsletter_form.privacy.errors %}form-field-error{% endif %}">
            {{ request.newsletter_form.privacy|safe }}
          </div>
        </div>
      </div>

      <div class="form-submit">
        <input type="submit" id="footer_email_submit"
               value="{{ _('Sign me up') }} »" class="button">

        <p class="form-details">
          <small>{{ _('We will only send you Mozilla-related information.') }}</small>
        </p>
      </div>
    </form>
  {% else %}
    <div id="footer-email-form" class="thank billboard">
      <h3>{{ _('Thanks! Please check your inbox to confirm your subscription.') }}</h3>
        <p>
          {% trans %}
            You'll receive an email from mozilla@e.mozilla.org to confirm your subscription.
            If you don't see it, check your spam filter. You must confirm your subscription to receive our newsletter.
          {% endtrans %}
        </p>
    </div>
  {% endif %}
{% endmacro %}

{% macro mozorg_newsletter_form() %}
  {# Note: This form differs from the email_newsletter_form() that appears on most pages;
    The global form submits to bedrock, this one submits to sendto.mozilla.org #}
<aside class="billboard newsletter-form">
  <form id="footer-email-form" method="post" action="https://sendto.mozilla.org/page/s/sign-up-for-mozilla">
    <h3>{{ _('Get Mozilla updates') }}</h3>

    <div class="form-contents">
      <div class="field field-email">
        <label for="id_email" class="hidden">{{ _('Email') }}</label>
        <input name="email" type="email" id="id_email" value="" required aria-required="true" placeholder="{{ _('YOUR EMAIL HERE') }}">
      </div>

      <div id="form-details">
        <!-- This is bad, but a quick fix because we are pushing live in an hour -->
        <div class="field field-country">
          <label for="country" class="hidden">{{ _('Country') }}</label>
          <select id="country" name="country">
            <option value=""></option>
            <option value="AF">Afghanistan</option>
            <option value="AL">Albania</option>
            <option value="DZ">Algeria</option>
            <option value="AS">American Samoa</option>
            <option value="AD">Andorra</option>
            <option value="AO">Angola</option>
            <option value="AI">Anguilla</option>
            <option value="AG">Antigua and Barbuda</option>
            <option value="AR">Argentina</option>
            <option value="AM">Armenia</option>
            <option value="AW">Aruba</option>
            <option value="AU">Australia</option>
            <option value="AT">Austria</option>
            <option value="AZ">Azerbaijan</option>
            <option value="BS">Bahamas</option>
            <option value="BH">Bahrain</option>
            <option value="BD">Bangladesh</option>
            <option value="BB">Barbados</option>
            <option value="BY">Belarus</option>
            <option value="BE">Belgium</option>
            <option value="BZ">Belize</option>
            <option value="BJ">Benin</option>
            <option value="BM">Bermuda</option>
            <option value="BT">Bhutan</option>
            <option value="BO">Bolivia</option>
            <option value="BA">Bosnia and Herzegovina</option>
            <option value="BW">Botswana</option>
            <option value="BR">Brazil</option>
            <option value="VG">British Virgin Islands</option>
            <option value="IO">British Indian Ocean Territory</option>
            <option value="BN">Brunei</option>
            <option value="BG">Bulgaria</option>
            <option value="BF">Burkina Faso</option>
            <option value="BI">Burundi</option>
            <option value="KH">Cambodia</option>
            <option value="CM">Cameroon</option>
            <option value="CA">Canada</option>
            <option value="CV">Cape Verde</option>
            <option value="KY">Cayman Islands</option>
            <option value="CF">Central African Republic</option>
            <option value="TD">Chad</option>
            <option value="CL">Chile</option>
            <option value="CN">China</option>
            <option value="CX">Christmas Island</option>
            <option value="CO">Colombia</option>
            <option value="KM">Comoros Islands</option>
            <option value="CD">Congo, Democratic Republic of the</option>
            <option value="CG">Congo, Republic of the</option>
            <option value="CK">Cook Islands</option>
            <option value="CR">Costa Rica</option>
            <option value="CI">Cote D'ivoire</option>
            <option value="HR">Croatia</option>
            <option value="CU">Cuba</option>
            <option value="CY">Cyprus</option>
            <option value="CZ">Czech Republic</option>
            <option value="DK">Denmark</option>
            <option value="DJ">Djibouti</option>
            <option value="DM">Dominica</option>
            <option value="DO">Dominican Republic</option>
            <option value="TP">East Timor</option>
            <option value="EC">Ecuador</option>
            <option value="EG">Egypt</option>
            <option value="SV">El Salvador</option>
            <option value="GQ">Equatorial Guinea</option>
            <option value="ER">Eritrea</option>
            <option value="EE">Estonia</option>
            <option value="ET">Ethiopia</option>
            <option value="FK">Falkland Islands (Malvinas)</option>
            <option value="FO">Faroe Islands</option>
            <option value="FJ">Fiji</option>
            <option value="FI">Finland</option>
            <option value="FR">France</option>
            <option value="GF">French Guiana</option>
            <option value="PF">French Polynesia</option>
            <option value="TF">French Southern Territories</option>
            <option value="GA">Gabon</option>
            <option value="GM">Gambia</option>
            <option value="GE">Georgia</option>
            <option value="DE">Germany</option>
            <option value="GH">Ghana</option>
            <option value="GI">Gibraltar</option>
            <option value="GR">Greece</option>
            <option value="GL">Greenland</option>
            <option value="GD">Grenada</option>
            <option value="GP">Guadeloupe</option>
            <option value="GU">Guam</option>
            <option value="GT">Guatemala</option>
            <option value="GN">Guinea</option>
            <option value="GW">Guinea-Bissau</option>
            <option value="GY">Guyana</option>
            <option value="HT">Haiti</option>
            <option value="VA">Holy See (Vatican City State)</option>
            <option value="HN">Honduras</option>
            <option value="HK">Hong Kong</option>
            <option value="HU">Hungary</option>
            <option value="IS">Iceland</option>
            <option value="IN">India</option>
            <option value="ID">Indonesia</option>
            <option value="IR">Iran</option>
            <option value="IQ">Iraq</option>
            <option value="IE">Ireland</option>
            <option value="IL">Israel</option>
            <option value="IT">Italy</option>
            <option value="JM">Jamaica</option>
            <option value="JP">Japan</option>
            <option value="JO">Jordan</option>
            <option value="KZ">Kazakhstan</option>
            <option value="KE">Kenya</option>
            <option value="KI">Kiribati</option>
            <option value="KR">South Korea</option>
            <option value="XK">Kosovo</option>
            <option value="KW">Kuwait</option>
            <option value="KG">Kyrgyzstan</option>
            <option value="LA">Laos</option>
            <option value="LV">Latvia</option>
            <option value="LB">Lebanon</option>
            <option value="LS">Lesotho</option>
            <option value="LR">Liberia</option>
            <option value="LI">Liechtenstein</option>
            <option value="LT">Lithuania</option>
            <option value="LU">Luxembourg</option>
            <option value="MO">Macau</option>
            <option value="MK">Macedonia</option>
            <option value="MG">Madagascar</option>
            <option value="MW">Malawi</option>
            <option value="MY">Malaysia</option>
            <option value="MV">Maldives</option>
            <option value="ML">Mali</option>
            <option value="MT">Malta</option>
            <option value="MH">Marshall Islands</option>
            <option value="MQ">Martinique</option>
            <option value="MR">Mauritania</option>
            <option value="MU">Mauritius</option>
            <option value="YT">Mayotte</option>
            <option value="MX">Mexico</option>
            <option value="FM">Micronesia</option>
            <option value="MD">Moldova, Republic of</option>
            <option value="MC">Monaco</option>
            <option value="MN">Mongolia</option>
            <option value="ME">Montenegro</option>
            <option value="MS">Montserrat</option>
            <option value="MA">Morocco</option>
            <option value="MZ">Mozambique</option>
            <option value="MM">Myanmar</option>
            <option value="NA">Namibia</option>
            <option value="NR">Nauru</option>
            <option value="NP">Nepal</option>
            <option value="NL">Netherlands</option>
            <option value="AN">Netherlands Antilles</option>
            <option value="NC">New Caledonia</option>
            <option value="NZ">New Zealand</option>
            <option value="NI">Nicaragua</option>
            <option value="NE">Niger</option>
            <option value="NG">Nigeria</option>
            <option value="NU">Niue</option>
            <option value="NF">Norfolk Island</option>
            <option value="MP">Northern Mariana Islands</option>
            <option value="NO">Norway</option>
            <option value="OM">Oman</option>
            <option value="PK">Pakistan</option>
            <option value="PW">Palau</option>
            <option value="PA">Panama</option>
            <option value="PG">Papua New Guinea</option>
            <option value="PY">Paraguay</option>
            <option value="PE">Peru</option>
            <option value="PH">Philippines</option>
            <option value="PN">Pitcairn Island</option>
            <option value="PL">Poland</option>
            <option value="PT">Portugal</option>
            <option value="PR">Puerto Rico</option>
            <option value="QA">Qatar</option>
            <option value="RE">Reunion</option>
            <option value="RO">Romania</option>
            <option value="RU">Russian Federation</option>
            <option value="RW">Rwanda</option>
            <option value="KN">Saint Kitts and Nevis</option>
            <option value="LC">Saint Lucia</option>
            <option value="VC">Saint Vincent and the Grenadines</option>
            <option value="WS">Samoa</option>
            <option value="SM">San Marino</option>
            <option value="ST">Sao Tome and Principe</option>
            <option value="SA">Saudi Arabia</option>
            <option value="SN">Senegal</option>
            <option value="RS">Serbia</option>
            <option value="SC">Seychelles</option>
            <option value="SL">Sierra Leone</option>
            <option value="SG">Singapore</option>
            <option value="SK">Slovakia</option>
            <option value="SI">Slovenia</option>
            <option value="SB">Solomon Islands</option>
            <option value="SO">Somalia</option>
            <option value="ZA">South Africa</option>
            <option value="ES">Spain</option>
            <option value="LK">Sri Lanka</option>
            <option value="SH">St. Helena</option>
            <option value="PM">St. Pierre and Miquelon</option>
            <option value="SD">Sudan</option>
            <option value="SR">Suriname</option>
            <option value="SZ">Swaziland</option>
            <option value="SE">Sweden</option>
            <option value="CH">Switzerland</option>
            <option value="SY">Syria</option>
            <option value="TW">Taiwan</option>
            <option value="TJ">Tajikistan</option>
            <option value="TZ">Tanzania</option>
            <option value="TH">Thailand</option>
            <option value="TG">Togo</option>
            <option value="TK">Tokelau</option>
            <option value="TO">Tonga</option>
            <option value="TT">Trinidad and Tobago</option>
            <option value="TN">Tunisia</option>
            <option value="TR">Turkey</option>
            <option value="TM">Turkmenistan</option>
            <option value="TC">Turks and Caicos Islands</option>
            <option value="TV">Tuvalu</option>
            <option value="UG">Uganda</option>
            <option value="UA">Ukraine</option>
            <option value="AE">United Arab Emirates</option>
            <option value="GB">United Kingdom</option>
            <option value="US" selected="selected">United States</option>
            <option value="UY">Uruguay</option>
            <option value="UZ">Uzbekistan</option>
            <option value="VU">Vanuatu</option>
            <option value="VE">Venezuela</option>
            <option value="VN">Viet Nam</option>
            <option value="VI">Virgin Islands (U.S.)</option>
            <option value="WF">Wallis and Futuna Islands</option>
            <option value="EH">Western Sahara</option>
            <option value="YE">Yemen</option>
            <option value="ZM">Zambia</option>
            <option value="ZW">Zimbabwe</option>
          </select>
        </div>

        <div class="field field-privacy">
          <label for="id_privacy" class="privacy-check-label">
            <input required aria-required="true" type="checkbox" name="custom-314" id="id_privacy" />
            <span class="title">{{ _('I’m okay with you handling this info as you explain in your <a href="%s">Privacy Policy</a>')|format('/en-US/privacy-policy') }}</span>
          </label>
        </div>
      </div>
    </div>

    <div class="form-submit">
      <input type="submit" id="footer_email_submit" value="{{ _('Sign me up') }} »" class="button">
      <p class="form-details"><small>{{ _('We will only send you Mozilla-related information.') }}</small></p>
    </div>
  </form>
</aside>
{% endmacro %}


{% macro facebook_share_url(url) -%}
  {{ 'https://www.facebook.com/sharer/sharer.php?u=%s'|format(url|urlencode)|e }}
{%- endmacro %}

{% macro twitter_share_url(url, tweet_text) -%}
  {{ 'https://www.twitter.com/intent/tweet?url=%s&text=%s'|format(url|urlencode, tweet_text|urlencode)|e }}
{%- endmacro %}