<?php echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>" ?>
<npgw3_script1>
    <coderr><?=$code ?></coderr> 
    <termid><?= $conf->terminal ?></termid> 
    <importo><?= number_format($p->getTotalCost(), 2, ',', '.') ?></importo> 
    <causale>
        <cod><?= $conf->code."-reg-".$p->id ?></cod> 
        <riga><?= $p->lastname." ".$p->firstname." ".$p->middlename ?></riga> 
        <riga><?= $conf->title.": ".$p->getRegType()->title ?></riga>
    </causale>
    <email><?= $p->email ?></email> 
    <language>EN</language> 
    <ipAddress><?= $p->ipaddress ?></ipAddress> 
</npgw3_script1>
