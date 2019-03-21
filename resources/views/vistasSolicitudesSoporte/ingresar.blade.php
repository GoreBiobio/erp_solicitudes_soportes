<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/notify.js"></script>
<script src="js/notify.min.js"></script>
<!DOCTYPE html>

<script type="text/javascript"> 
   

function validarRut(rut) {
  if(Rut(rut)){
    window.document.form1.submit();
  }
}

function revisarDigito( dvr )
{ 
  dv = dvr + "" 
  if ( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K') 
  {   
    $.notify("Debe ingresar un digito verificador valido","warn");   
    window.document.form1.rut.focus();    
    window.document.form1.rut.select();   
    return false; 
  } 
  return true;
}

function revisarDigito2( crut )
{ 
  largo = crut.length;  
  if ( largo < 2 )  
  {   
    $.notify("Debe ingresar el rut completo","warn");    
    window.document.form1.rut.focus();    
    window.document.form1.rut.select();   
    return false; 
  } 
  if ( largo > 2 )    
    rut = crut.substring(0, largo - 1); 
  else    
    rut = crut.charAt(0); 
  dv = crut.charAt(largo-1);  
  revisarDigito( dv );  

  if ( rut == null || dv == null )
    return 0  

  var dvr = '0' 
  suma = 0  
  mul  = 2  

  for (i= rut.length -1 ; i >= 0; i--)  
  { 
    suma = suma + rut.charAt(i) * mul   
    if (mul == 7)     
      mul = 2   
    else          
      mul++ 
  } 
  res = suma % 11 
  if (res==1)   
    dvr = 'k' 
  else if (res==0)    
    dvr = '0' 
  else  
  {   
    dvi = 11-res    
    dvr = dvi + ""  
  }
  if ( dvr != dv.toLowerCase() )  
  {   
    $.notify("EL rut es incorrecto","warn"); 
    window.document.form1.rut.focus();    
    window.document.form1.rut.select();   
    return false  
  }

  return true
}

function Rut(texto)
{ 
  var tmpstr = "";  
  for ( i=0; i < texto.length ; i++ )   
    if ( texto.charAt(i) != ' ' && texto.charAt(i) != '.' && texto.charAt(i) != '-' )
      tmpstr = tmpstr + texto.charAt(i);  
  texto = tmpstr; 
  largo = texto.length; 

  if ( largo < 2 )  
  {    
    $.notify("Debe ingresar el rut completo","warn");
    window.document.form1.rut.focus();    
    window.document.form1.rut.select();   
    return false; 
  } 

  for (i=0; i < largo ; i++ ) 
  {     
    if ( texto.charAt(i) !="0" && texto.charAt(i) != "1" && texto.charAt(i) !="2" && texto.charAt(i) != "3" && texto.charAt(i) != "4" && texto.charAt(i) !="5" && texto.charAt(i) != "6" && texto.charAt(i) != "7" && texto.charAt(i) !="8" && texto.charAt(i) != "9" && texto.charAt(i) !="k" && texto.charAt(i) != "K" )
    {     
       $.notify("El valor ingresado no corresponde a un R.U.T valido","warn");    
      window.document.form1.rut.focus();      
      window.document.form1.rut.select();     
      return false;   
    } 
  } 

  var invertido = ""; 
  for ( i=(largo-1),j=0; i>=0; i--,j++ )    
    invertido = invertido + texto.charAt(i);  
  var dtexto = "";  
  dtexto = dtexto + invertido.charAt(0);  
  dtexto = dtexto + '-';  
  cnt = 0;  

  for ( i=1,j=2; i<largo; i++,j++ ) 
  {   
    //alert("i=[" + i + "] j=[" + j +"]" );   
    if ( cnt == 3 )   
    {     
      dtexto = dtexto + '.';      
      j++;      
      dtexto = dtexto + invertido.charAt(i);      
      cnt = 1;    
    }   
    else    
    {       
      dtexto = dtexto + invertido.charAt(i);      
      cnt++;    
    } 
  } 

  invertido = ""; 
  for ( i=(dtexto.length-1),j=0; i>=0; i--,j++ )    
    invertido = invertido + dtexto.charAt(i); 

  window.document.form1.rut.value = invertido.toUpperCase()   

  if ( revisarDigito2(texto) )    
    return true;  

  return false;
}

</script>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Soportes</b></a>
  </div>
  <!-- /.login-logo -->

 
              
  <div class="login-box-body">
    <p class="login-box-msg">Ingresar Rut</p>

    <form action="recibeRun" method="post" name="form1">
      <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
      <div class="form-group has-feedback">
        <input type="text" name="rut" id="rut" class="form-control" placeholder="11.111.111-1" value="{{$rutIngresado}}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" id="enviaRut" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>

@if ($rutinvalido == '1') 

<div class="col-md-6 col-md-offset-3">
      <div class="box-body">

              <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alerta!</h4>
                Rut No Corresponde a Usuario GORE Bio-Bio o no ha sido registrado.
              </div>
            </div> 
    </div> 

@endif

       
<!-- /.login-box -->


<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>

<style type="text/css">
.notifyjs-happyblue-base {
  white-space: nowrap;
  background-color: lightblue;
  padding: 5px;
}
.notifyjs-happyblue-superblue {
  color: white;
  background-color: blue;
}
</style>

<script>
  $(function () {


    $.notify.addStyle('happyblue', {
    html: "<div>☺<span data-notify-text/>☺</div>",
    classes: {
      base: {
        "white-space": "nowrap",
        "background-color": "lightblue",
        "padding": "px"
      },
      superblue: {
        "color": "white",
        "background-color": "blue"
      }
    }
  });




    $("#enviaRut").click(function(){

      /*$.notify('hello !!', {
        style: 'happyblue',
        position: 'bottom-rigth'
      });*/

      validarRut($("#rut").val());
    });
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>