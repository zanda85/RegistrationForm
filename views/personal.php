<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Registration - personal information</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <script src="js/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" >
        <link rel="stylesheet" href="css/custom.css" >
        <script src="js/bootstrap.min.js"></script>
        
        <script src="js/personal.js"></script>
    </head>
    <body>
        <div class="container">
            
            <form class="form-horizontal">
                <img src="<?= $logo ?>" alt="conference logo" class="img-fluid" style="width: 100%"/>
                <h2>Personal information</h2>
                <div class="well">
                    <div class="form-group">
                        <label for="email1" class="col-sm-2 control-label" >Email *</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email1" name="email1" placeholder="your email" data-required="true">
                            <span id="email1-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email2" class="col-sm-2 control-label">Verify Email *</label>
                        <div class="col-sm-10">
                            <input type="email"  class="form-control" id="email2" name="email2" placeholder="your email again" data-required="true">
                            <span id="email2-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prefix" class="col-sm-2 control-label">Prefix</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="prefix" name="prefix" placeholder="Mr., Mrs., etc.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="name" name="name" placeholder="Marco" data-required="true">
                            <span id="name-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middleName" class="col-sm-2 control-label">Middle Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Tullio">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastName" class="col-sm-2 control-label">Last Name *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="lastName" name="lastName" placeholder="Cicerone" data-required="true">
                            <span id="lastName-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jobTitle" class="col-sm-2 control-label">Job Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jobTitle" name="jobTitle" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="badgeName" class="col-sm-2 control-label">Name on Badge *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="badgeName" name="badgeName" placeholder="your name, as it would appear on the badge" data-required="true">
                            <span id="badgeName-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company" class="col-sm-2 control-label">Company/Organization *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="company" name="company" placeholder="" data-required="true">
                            <span id="company-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country" class="col-sm-2 control-label">Country *</label>
                        <div class="col-sm-10">
                            <select id="country"  class="form-control" name="contry" data-required="true">
                                <option value=""></option>
                                <option value="AF">Afghanistan</option>
                                <option value="AX">Aland Islands</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
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
                                <option value="BE">Belgium</option>
                                <option value="BZ">Belize</option>
                                <option value="BM">Bermuda</option>
                                <option value="BT">Bhutan</option>
                                <option value="BO">Bolivia</option>
                                <option value="BA">Bosnia and Herzegovina</option>
                                <option value="BW">Botswana</option>
                                <option value="BV">Bouvet Island</option>
                                <option value="BR">Brazil</option>
                                <option value="IO">British Indian Ocean Territory</option>
                                <option value="BN">Brunei Darussalam</option>
                                <option value="BG">Bulgaria</option>
                                <option value="BF">Burkina Faso</option>
                                <option value="BI">Burundi</option>
                                <option value="KH">Cambodia</option>
                                <option value="CA">Canada</option>
                                <option value="CV">Cape Verde</option>
                                <option value="KY">Cayman Islands</option>
                                <option value="CF">Central African Republic</option>
                                <option value="TD">Chad</option>
                                <option value="CL">Chile</option>
                                <option value="CN">China</option>
                                <option value="CX">Christmas Island</option>
                                <option value="CC">Cocos (Keeling) Islands</option>
                                <option value="CO">Colombia</option>
                                <option value="KM">Comoros</option>
                                <option value="CD">Congo, The Democratic Republic of</option>
                                <option value="CK">Cook Islands</option>
                                <option value="CR">Costa Rica</option>
                                <option value="HR">Croatia</option>
                                <option value="CY">Cyprus</option>
                                <option value="CZ">Czech Republic</option>
                                <option value="DK">Denmark</option>
                                <option value="DJ">Djibouti</option>
                                <option value="DM">Dominica</option>
                                <option value="DO">Dominican Republic</option>
                                <option value="EC">Ecuador</option>
                                <option value="EG">Egypt</option>
                                <option value="SV">El Salvador</option>
                                <option value="GQ">Equatorial Guinea</option>
                                <option value="ER">Eritrea</option>
                                <option value="EE">Estonia</option>
                                <option value="ET">Ethiopia</option>
                                <option value="FK">Falkland Islands</option>
                                <option value="FO">Faroe Islands</option>
                                <option value="FM">Federated States of Micronesia</option>
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
                                <option value="GI">Gibraltar</option>
                                <option value="GR">Greece</option>
                                <option value="GL">Greenland</option>
                                <option value="GD">Grenada</option>
                                <option value="GP">Guadeloupe</option>
                                <option value="GU">Guam</option>
                                <option value="GT">Guatemala</option>
                                <option value="GG">Guernsey</option>
                                <option value="GN">Guinea</option>
                                <option value="GW">Guinea-Bissau</option>
                                <option value="GY">Guyana</option>
                                <option value="HT">Haiti</option>
                                <option value="HM">Heard and Mc Donald Islands</option>
                                <option value="VA">HOLY SEE (VATICAN CITY STATE)</option>
                                <option value="HN">Honduras</option>
                                <option value="HK">Hong Kong</option>
                                <option value="HU">Hungary</option>
                                <option value="IS">Iceland</option>
                                <option value="IN">India</option>
                                <option value="ID">Indonesia</option>
                                <option value="IE">Ireland</option>
                                <option value="IM">Isle Of Man</option>
                                <option value="IL">Israel</option>
                                <option selected="selected" value="IT">Italy</option>
                                <option value="JM">Jamaica</option>
                                <option value="JP">Japan</option>
                                <option value="JE">Jersey</option>
                                <option value="JO">Jordan</option>
                                <option value="KZ">Kazakhstan</option>
                                <option value="KE">Kenya</option>
                                <option value="KI">Kiribati</option>
                                <option value="KR">Korea, Republic of</option>
                                <option value="KV">Kosovo</option>
                                <option value="KW">Kuwait</option>
                                <option value="KG">Kyrgyzstan</option>
                                <option value="LA">Lao People's Democratic Republic</option>
                                <option value="LV">Latvia</option>
                                <option value="LS">Lesotho</option>
                                <option value="LI">Liechtenstein</option>
                                <option value="LT">Lithuania</option>
                                <option value="LU">Luxembourg</option>
                                <option value="MO">Macao</option>
                                <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
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
                                <option value="FM">Micronesia, Federated States of</option>
                                <option value="MD">Moldova, Republic of</option>
                                <option value="MC">Monaco</option>
                                <option value="MN">Mongolia</option>
                                <option value="ME">Montenegro</option>
                                <option value="MS">Montserrat</option>
                                <option value="MA">Morocco</option>
                                <option value="MZ">Mozambique</option>
                                <option value="NA">Namibia</option>
                                <option value="NR">Nauru</option>
                                <option value="NP">Nepal</option>
                                <option value="NL">Netherlands</option>
                                <option value="AN">Netherlands Antilles</option>
                                <option value="NZ">New Zealand</option>
                                <option value="NI">Nicaragua</option>
                                <option value="NF">Norfolk Island</option>
                                <option value="MP">Northern Mariana Islands</option>
                                <option value="NO">Norway</option>
                                <option value="OM">Oman</option>
                                <option value="PK">Pakistan</option>
                                <option value="PW">Palau</option>
                                <option value="PS">Palestine, State of</option>
                                <option value="PA">Panama</option>
                                <option value="PG">Papua New Guinea</option>
                                <option value="PY">Paraguay</option>
                                <option value="PE">Peru</option>
                                <option value="PH">Philippines</option>
                                <option value="PN">Pitcairn</option>
                                <option value="PL">Poland</option>
                                <option value="PT">Portugal</option>
                                <option value="PR">Puerto Rico</option>
                                <option value="QA">Qatar</option>
                                <option value="RE">Reunion</option>
                                <option value="RO">Romania</option>
                                <option value="RU">Russian Federation</option>
                                <option value="RW">Rwanda</option>
                                <option value="BL">Saint Barthelemy</option>
                                <option value="SH">Saint Helena</option>
                                <option value="KN">Saint Kitts and Nevis</option>
                                <option value="LC">Saint Lucia</option>
                                <option value="MF">Saint Martin</option>
                                <option value="PM">Saint Pierre and Miquelon</option>
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
                                <option value="ZA">South Africa</option>
                                <option value="GS">South Georgia &amp; South Sandwich Islands</option>
                                <option value="SS">South Sudan</option>
                                <option value="ES">Spain</option>
                                <option value="LK">Sri Lanka</option>
                                <option value="SR">Suriname</option>
                                <option value="SJ">Svalbard and Jan Mayen</option>
                                <option value="SZ">Swaziland</option>
                                <option value="SE">Sweden</option>
                                <option value="CH">Switzerland</option>
                                <option value="TW">Taiwan</option>
                                <option value="TJ">Tajikistan</option>
                                <option value="TZ">Tanzania, United Republic</option>
                                <option value="TH">Thailand</option>
                                <option value="TL">Timor-Leste</option>
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
                                <option value="US">United States</option>
                                <option value="UM">United States Minor Outlying Islands</option>
                                <option value="UY">Uruguay</option>
                                <option value="UZ">Uzbekistan</option>
                                <option value="VU">Vanuatu</option>
                                <option value="VE">Venezuela</option>
                                <option value="VN">Vietnam</option>
                                <option value="VG">Virgin Islands (British)</option>
                                <option value="VI">Virgin Islands (U.S.)</option>
                                <option value="WF">Wallis and Futuna Islands</option>
                                <option value="EH">Western Sahara</option>
                                <option value="YE">Yemen</option>
                            </select>
                            <span id="country-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address1" class="col-sm-2 control-label">Address Line 1 *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="address1" name="address1" placeholder="" data-required="true">
                            <span id="address1-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address2" class="col-sm-2 control-label">Address Line 2</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address2" name="address2" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-sm-2 control-label">City *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="city" name="city" placeholder="" data-required="true">
                            <span id="city-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zip" class="col-sm-2 control-label">ZIP/Postal Code *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="zip" name="zip" placeholder="" data-required="true">
                            <span id="zip-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="taxNumber" class="col-sm-2 control-label">Tax identification Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="taxNumber" name="taxNumber" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="acm" class="col-sm-2 control-label">ACM Membership Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="acm" name="taxNumber" placeholder="">
                        </div>
                    </div>
                </div>

                <h2>Dietary Restrictions</h2>
                <div class="well">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="meatFree" name="diet">
                                    Meat free diet
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="fishFree" name="diet">
                                    Fish free diet
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="ShellFishFree" name="diet">
                                    Shellfish free diet
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="eggFree" name="diet">
                                    Egg free diet
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="MilkFishFree" name="diet">
                                    Milk/Lactose free diet
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="animalFree" name="diet">
                                    Diet free of animal derived products
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="glutenFree" name="diet">
                                    Gluten free diet
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="peanutFree" name="diet">
                                    Peanut Free diet
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="wheatFree" name="diet">
                                    Wheat free diet
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="soyFree" name="diet">
                                    Soy Free
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="otherDiet" class="col-sm-2 control-label">List additional dietary restrictions of which we need to be aware</label>
                        <div class="col-sm-10">
                            <textarea rows="6" class="form-control" id="otherDiet" name="otherDiet" placeholder=" For instance, any other allergies and intolerances that you may have, or any cultural/religious restrictions." ></textarea>
                        </div>
                    </div>
                </div>
                
                <button id="continue" type="submit" class="btn btn-primary center-block">Continue</button>
                
            </form>
        </div>
    </body>
</html>
