<?php
session_start();
include "include/header.php";
include "siteconfig/confff.php";
if (!isset($_SESSION["username_session"])) {
include "include/logform.php";
}
else {
middle();
} 
function middle()
{
include "siteconfig/confff.php";
$id=$_SESSION["username_session"];
$username=$_SESSION["username_session"];
$rs = mysql_query("select * from allussers where Username='$id'");
$arr=mysql_fetch_array($rs);
$ref_by=$arr[11];
$status=$arr[14];
$unpaid=$arr[16];
$rsm1=mysql_query("select * from ussersmatrix$startussersmatrix where Username='$username'");
$snum=mysql_num_rows($rsm1);
?>
	<div class="wrapper">	
		<div class="centerblock">
<?
include "include/accountmenu.php";
?>
<div class="title"><h1>Оплата вступительного взноса</h1></div>
<?php
include "siteconfig/confff.php";
if($status!=1) {
?>
<p><center>Вы уже оплатили!<br><br><img src="images/biglogo.png"></center></p>
<?php	
}
else {
if(!$_POST) {
$package=1;
$rsm=mysql_query("select * from ussersmatrices where ID=$package");
$perror=mysql_num_rows($rsm);
$perror1=0;
if($perror>0) {
if($status==1) {
$m=0;
$rsm=mysql_query("select * from ussersmatrices order by ID");
while($arrm=mysql_fetch_array($rsm)) {
$m++;
if($m==1) {
if($arrm[0]==$package) $perror1=1;
}
else {
if($pospurnextlevel==1) {
if($arrm[0]==$package) $perror1=1;
}
}
} 
} 
else {
$rsm=mysql_query("select * from ussersmatrices order by ID");
while($arrm=mysql_fetch_array($rsm)) {
$rsm1=mysql_query("select * from ussersmatrix$arrm[0] where Username='$username'");
$num=mysql_num_rows($rsm1);
if($pospurnextlevel==0) {
if($num>0&&$multipurchaseallowed==1&&$num<$maxposperlevel) {
if($arrm[0]==$package) $perror1=1;
}
}
else {
if($num==0) {
if($arrm[0]==$package) $perror1=1;
}
elseif($multipurchaseallowed==1&&$num<$maxposperlevel) {
if($arrm[0]==$package) $perror1=1;
}
}
} 
} 
}
$pmode=perfectmoney;
$rsm=mysql_query("select * from ussersmatrices where ID=$package");
$arrm=mysql_fetch_array($rsm);
$amount=$arrm[2];
$rst=mysql_query("select * from btransactions where ussersmatrixid=$package and Username='$username' and PaymentMode='$pmode'");
if(mysql_num_rows($rst)>0) {
$arrt=mysql_fetch_array($rst);
$b=$arrt[0];
}
else {
$sql_i="insert into btransactions(Username,PaymentMode,ussersmatrixid,Date) values('$username','$pmode',$package,now())";
$rs=mysql_query($sql_i);
$b=mysql_insert_id();
}
$profee=$amount;
$fee=$amount;
?>             
<table width="100%">
<tr><td align="left"><h5><span>$</span><? echo $fee; ?> Perfect Money</h5></td>
<td align="right"><form action="https://perfectmoney.is/api/step1.asp" method="POST">			
<input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo $perfectmoney; ?>">
<input type="hidden" name="PAYEE_NAME" value="<?php echo $sitename; ?>">
<input type="hidden" name="PAYMENT_ID" value="ID_<?php echo $b; ?>_user_<? echo $username; ?>">
<input type="hidden" name="PAYMENT_AMOUNT" value="<? echo $fee; ?>">
<input type="hidden" name="PAYMENT_UNITS" value="USD">
<input type="hidden" name="STATUS_URL" value="mailto:<? echo $webmasteremail; ?>">
<input type="hidden" name="PAYMENT_URL" value="<?php echo $siteurl; ?>/ok.php">
<input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
<input type="hidden" name="NOPAYMENT_URL" value="<?php echo $siteurl; ?>/account.php">
<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
<input type="hidden" name="SUGGESTED_MEMO" value="ID_<?php echo $b; ?>_user_<? echo $username; ?>">
<input type="hidden" name="BAGGAGE_FIELDS" value="">
<input type="submit" name="PAYMENT_METHOD" class="button" value="Оплатить"></form></td></tr>
<? if (!empty($qiwi)) { ?>
<tr><td colspan="2"><hr></td></tr>
<tr><td align="left"><h5><? echo ($fee*$dolkurs); ?> <span>рублей</span> QIWI</h5></td>
<td align="right"><script type="text/javascript">
var ie = document.all;
var moz = (navigator.userAgent.indexOf("Mozilla") != -1);
var opera = window.opera;
var brodilka = "";
if(ie && !opera){brodilka = "ie";}
else if(moz){brodilka = "moz";}
else if(opera){brodilka = "opera";}
var inputMasks = new Array();

function kdown(inpt, ev){
    var id = inpt.getAttribute("id");
    var idS = id.substring(0, id.length - 1);
    var idN = Number(id.substring(id.length - 1));
    inputMasks[idS].BlKPress(idN, inpt, ev);
}

function kup(inpt, ck){
    if(Number(inpt.getAttribute("size")) == inpt.value.length){
        var id = inpt.getAttribute("id");
        var idS = id.substring(0, id.length - 1);
        var idN = Number((id.substring(id.length - 1))) + 1;
        var t = document.getElementById(idS + idN);
        if(ck!=8 && ck!=9){
            if(t){t.focus();}
        } else if (ck==8) {
            inpt.value = inpt.value.substring(0, inpt.value.length - 1);
        }
    }
}

function Mask(fieldObj){
    var template = "(\\d{3})\\d{3}-\\d{2}-\\d{2}";
    var parts = [];
    var blocks = [];
    var order = [];
    var value = "";

    var Block = function(pattern){
        var inptsize = Number(pattern.substring(3, pattern.indexOf('}')));
        var idS = fieldObj.getAttribute("id");
        var idN = blocks.length;
        var text = "";

        var checkKey = function(ck){
            return ((ck >= 48) && (ck <= 57)) || ((ck >= 96) && (ck <= 105)) || (ck == 27) || (ck == 8) || (ck == 9) || (ck == 13) || (ck == 45) || (ck == 46) || (ck == 144) || ((ck >= 33) && (ck <= 40)) || ((ck >= 16) && (ck <= 18)) || ((ck >= 112) && (ck <= 123));
        }

        this.makeInput = function(){
            return "<input type='text' " + "size='" + inptsize + "' maxlength='" + inptsize + "'"  + " id='" + idS + idN + "' onKeyDown='kdown(this, event)' onKeyUp='kup(this, event.keyCode)' value='" + text + "'>";
        }

        this.key = function(inpt, ev){
            if(opera) return;
            if(!checkKey(ev.keyCode)){
                switch(brodilka){
                    case "ie":
                        ev.cancelBubble = true;
                        ev.returnValue = false;
                    break;
                    case "moz":
                        ev.preventDefault();
                        ev.stopPropagation();
                    break;
                    case "opera":
                    break;
                    default:
                }
                return;
            }

            if(ev.keyCode == 8 && inpt.value == ""){
                var tid = inpt.getAttribute("id");
                var tidS = tid.substring(0, tid.length - 1);
                var tidN = Number(tid.substring(tid.length - 1)) - 1;
                var t = document.getElementById(tidS + tidN);
                if(t != null) t.focus();
            }
        }

        this.getText = function(){
            text = document.getElementById(idS + idN).value;
            return text;
        }

        this.setText = function(val){
            text = val;
        }

        this.getSize = function() {
            return inptsize;
        }
    }

    this.drawInputs = function(){
        var inputStr = "<span class='Field'>";
        var p = 0;
        var b = 0;
        for (var i = 0; i < order.length; i++) {
            if (order[i] == "p") {
                inputStr += parts[p];
                p++;
            } else {
                inputStr += blocks[b].makeInput();
                b++;
            }
        }
        inputStr += "</span>";
        document.getElementById("div_" + fieldObj.getAttribute("id")).innerHTML = inputStr;
        fieldObj.style.display = "none";
    }

    this.buildFromFields = function() {// constructor
        var tmpstr = template;
        while(tmpstr.indexOf("\\") != -1){
            var slash = tmpstr.indexOf("\\");
            var d = "";
            if(tmpstr.substring(0, slash) != ""){
                parts[parts.length] = tmpstr.substring(0, slash);
                order[order.length] = 'p';
                tmpstr = tmpstr.substring(slash);
            }
            var q = tmpstr.indexOf('}');
            blocks[blocks.length] = new Block(tmpstr.substring(0, q + 1), d);
            tmpstr = tmpstr.substring(q + 1);
            order[order.length] = 'b';
        }
        if (tmpstr != "") {
            parts[parts.length] = tmpstr;
            order[order.length] = 'p';
        }
        this.drawInputs();
    }

    this.buildFromFields();

    this.BlKPress = function(idN, inpt, ev){
        blocks[idN].key(inpt, ev);
    }

    this.makeHInput = function(){
        var name = fieldObj.getAttribute("name");
        document.getElementById("div_" + fieldObj.getAttribute("id")).innerHTML =
            "<input type='text' readonly='readonly' name='" + name + "' value='" + this.getValue() + "'>";
    }

    this.getFName = function(){
        return fieldObj.getAttribute("name");
    }

    this.getValue = function(){
        value = "";
        var p = 0;
        var b = 0;
        for(var i = 0; i < order.length; i++){
            /*if(order[i] == 'p'){
                value += parts[p];
                p++;
            } else {
                value += blocks[b].getText();
                b++;
            }
            */
        	if (order[i] != 'p') {
        		value += blocks[b].getText();
        		b++;
        	}
        }
        return value;
    }

    this.check = function(){
        for(var i in blocks){
            if (blocks[i].getText().length == 0) return false;
        }
        return true;
    }
}
</script>
<form action="http://w.qiwi.ru/setInetBill_utf.do" method="get" accept-charset="UTF-8" onSubmit="return checkSubmit();">
<input type="hidden" name="from" value="<?php echo $qiwi; ?>"/>
<input type="hidden" name="lifetime" value="192.0"/>
<input type="hidden" name="check_agt" value="false"/>
<input type="hidden" name="txn_id" value="ID_<?php echo $b; ?>_user_<? echo $username; ?>"/>
<div class="tooltipq">
<input type="text" name="to" id="idto"></input>
<span id="div_idto"></span>
<div class="tooltipqq">Введите номер своего мобильного телефона<br>без кода страны (пример: 9057772233).</div></div>
<script type="text/javascript">
	inputMasks["idto"] = new Mask(document.getElementById("idto"));
	function checkSubmit() {
		if (inputMasks["idto"].getValue().match(/^\d{10}$/)) {
			document.getElementById("idto").setAttribute("disabled", "disabled");
			inputMasks["idto"].makeHInput();
			return true;
		} else {
			alert("Введите номер телефона в федеральном формате без \"8\" и без \"+7\"");
			return false;
		}
	}
</script>
<input type="hidden" name="amount_rub" value="<? echo ($fee*$dolkurs); ?>" maxlength="5" />
<input type="hidden" name="amount_kop" value="" maxlength="2" size="2" />
<input type="hidden" name="com" value="ID_<?php echo $b; ?>_user_<? echo $username; ?>">					
<input type="submit" name="PAYMENT_METHOD" class="button" value="Оплатить"></form></td></tr>
<? } ?>
</table>
<?
}
}
?>
		</div>
		<? include "include/rightblock.php"; ?>
	</div>
<?
} include "include/footer.php";
?>