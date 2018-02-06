<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Registration - personal information</title>
        <meta charset="ISO-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <script src="js/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" >
        <link rel="stylesheet" href="css/custom.css" >
        <link rel="stylesheet" href="css/jquery-ui.min.css" >
        <link rel="stylesheet" href="css/jquery-ui.structure.min.css" >
        <link rel="stylesheet" href="css/jquery-ui.theme.min.css" >
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>

        <script src="js/personal.js"></script>
    </head>
    <body>
        <div class="container">

            <form class="form-horizontal" method="post" action="index.php">
                <img src="<?= $keys->logo ?>" alt="conference logo" class="img-fluid" style="width: 100%"/>
                <h2>Personal information</h2>
                <div class="well">
                    <div class="form-group">
                        <label  class="col-sm-2 control-label" >Email</label>
                        <div class="col-sm-10">
                            <span style="text-align: left"  class="col-sm-10 control-label" ><?= $p->email ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label" >Registration</label>
                        <div class="col-sm-10">
                            <span style="text-align: left" class="left-align col-sm-10 control-label "><?= $p->getRegType()->title ?> (<?= $p->getRegType()->cost ?>&euro;)</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prefix" class="col-sm-2 control-label">Prefix</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="prefix" 
                                   value="<?= $p->prefix ?>"
                                   name="prefix" placeholder="Mr., Mrs., etc.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="name" name="name" 
                                   value="<?= $p->firstname ?>"
                                   placeholder="Marco" data-required="true">
                            <span id="name-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middleName" class="col-sm-2 control-label">Middle Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="middleName" 
                                   value="<?= $p->middlename ?>"
                                   name="middleName" placeholder="Tullio">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastName" class="col-sm-2 control-label">Last Name *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="lastName" name="lastName" 
                                   value="<?= $p->lastname ?>"
                                   placeholder="Cicerone" data-required="true">
                            <span id="lastName-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="birthPlace" class="col-sm-2 control-label">Place of birth *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="birthPlace" name="birthPlace" 
                                   value="<?= $p->birthPlace ?>">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="birthDate" class="col-sm-2 control-label">Date of birth *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="birthDate" name="birthDate" 
                                   value="<?= $p->birthDate ?>"   placeholder="mm/dd/yyyy">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jobTitle" class="col-sm-2 control-label">Job Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jobTitle" 
                                   value="<?= $p->jobtitle ?>"
                                   name="jobTitle" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="badgeName" class="col-sm-2 control-label">Name on Badge *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="badgeName" name="badgeName" 
                                   value="<?= $p->badge ?>"
                                   placeholder="your name, as it would appear on the badge" data-required="true">
                            <span id="badgeName-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company" class="col-sm-2 control-label">Company or Organization *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="company" 
                                   value="<?= $p->company ?>"
                                   name="company" placeholder="" data-required="true">
                            <span id="company-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <?php if ($p->getRegType()->hasMembership == 1) { ?>
                        <div class="form-group">
                            <label for="membershipName" class="col-sm-2 control-label">Member of * </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="membershipName" 
                                       value="<?= $p->membershipName ?>"
                                       name="membershipName" placeholder="the name of the organization eligible for the discounted fee" data-required="true"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="membershipId" class="col-sm-2 control-label">Membership Number *</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="membershipId" 
                                       value="<?= $p->membershipId ?>"
                                       name="membershipId" placeholder="your organization membership number" data-required="true">
                            </div>
                        </div>
                    <?php } ?>

                </div>

                <h2>Billing information</h2>
                <div class="well">
                    <div class="form-group">
                        <label for="country" class="col-sm-2 control-label">Invoice type *</label>
                        <div class="col-sm-10">
                            <div class="checkbox">

                                <input type="radio" value="personal" name="invoice" 
                                       <?php if ($p->invoiceType == 0) { ?>
                                                checked="checked"
                                            <?php } ?>>
                                Address the invoice to me <br/>
                                <input type="radio" value="organization" name="invoice" 
                                       <?php if ($p->invoiceType == 1) { ?>
                                                checked="checked"
                                            <?php } ?>>
                                Address the invoice to my organization

                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="address1" class="col-sm-2 control-label">Address Line 1 *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="address1" name="address1" 
                                   value="<?= $p->addressline1 ?>"
                                   placeholder="Insert your personal or your organization address, according to the invoice type" data-required="true">
                            <span id="address1-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address2" class="col-sm-2 control-label">Address Line 2</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address2" 
                                   value="<?= $p->addressline2 ?>"
                                   name="address2" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-sm-2 control-label">City *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="city" name="city" 
                                   value="<?= $p->city ?>"
                                   placeholder="" data-required="true">
                            <span id="city-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zip" class="col-sm-2 control-label">ZIP/Postal Code *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="zip" name="zip" 
                                   value="<?= $p->zip ?>"
                                   placeholder="" data-required="true">
                            <span id="zip-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="country" class="col-sm-2 control-label">Country *</label>
                        <div class="col-sm-10">
                            <select id="country"  class="form-control" name="contry" data-required="true">
                                <option value=""></option>
                                <?php foreach ($nations as $key => $value) { ?>
                                    <option value="<?= $key ?>"
                                    <?php if ($key == $p->country) { ?>
                                                selected="selected"
                                            <?php } ?>>
                                                <?= $value ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span id="country-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cf" class="col-sm-2 control-label">CF *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="cf" name="cf" 
                                   value="<?= $p->cf ?>"
                                   placeholder="the italian 'Codice Fiscale'">
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="idNumber" class="col-sm-2 control-label">ID Number *</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="idNumber" name="idNumber" 
                                   value="<?= $p->idNumber ?>"
                                   placeholder="A valid ID or Passport number" >
                            
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="vat" class="col-sm-2 control-label">VAT number *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="vat" 
                                   value="<?= $p->vat ?>" data-required="true"
                                   name="vat" placeholder="">
                        </div>
                    </div>


                </div>

                <h2>Dietary Restrictions</h2>
                <div class="well">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="meatFree" name="diet[]" 
                                           <?= $p->meatfree == 1 ? "checked='checked'" : "" ?>>
                                    Meat free diet
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="fishFree" name="diet[]" 
                                           <?= $p->fishfree == 1 ? "checked='checked'" : "" ?>>
                                    Fish free diet
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="shellFishFree" name="diet[]" 
                                           <?= $p->shellfishfree == 1 ? "checked='checked'" : "" ?>>
                                    Shellfish free diet
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="eggFree" name="diet[]"
                                           <?= $p->eggfree == 1 ? "checked='checked'" : "" ?>>
                                    Egg free diet
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="milkFree" name="diet[]"
                                           <?= $p->milkfree == 1 ? "checked='checked'" : "" ?>>
                                    Milk/Lactose free diet
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="animalFree" name="diet[]"
                                           <?= $p->animalfree == 1 ? "checked='checked'" : "" ?>>
                                    Diet free of animal derived products
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="glutenFree" name="diet[]"
                                           <?= $p->glutenfree == 1 ? "checked='checked'" : "" ?>>
                                    Gluten free diet
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="peanutFree" name="diet[]"
                                           <?= $p->peanutfree == 1 ? "checked='checked'" : "" ?>>
                                    Peanut Free diet
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="wheatFree" name="diet[]"
                                           <?= $p->wheatfree == 1 ? "checked='checked'" : "" ?>>
                                    Wheat free diet
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="soyFree" name="diet[]"
                                           <?= $p->soyfree == 1 ? "checked='checked'" : "" ?>>
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
                            <textarea rows="6" class="form-control" id="otherDiet" name="otherDiet" 
                                      placeholder=" For instance, any other allergies and intolerances that you may have, or any cultural/religious restrictions." ><?= $p->additionaldiet ?></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="step" value="s2">
                <input type="hidden" name="partId" value="<?= $keys->participantId ?>">
                <input type="hidden" name="conf" value="<?= $keys->conf ?>">
                <button id="continue" type="submit" class="btn btn-primary center-block">Continue</button>

            </form>
        </div>
    </body>
</html>
