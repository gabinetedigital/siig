
//imagem (gif animado) para exibir enquanto processa
var loader = "../jsc/ajax-loader.gif";


/*********************************************/
function MakeObjectHttp(){
    var objAjax;
    if ( window.XMLHttpRequest ) {
        objAjax = new XMLHttpRequest();
    }else if ( window.ActiveXObject ){
        try {
            objAjax = new ActiveXObject('Msxml2.XMLHTTP');
        }catch(e1){
            try{
                objAjax = new ActiveXObject('Microsoft.XMLHTTP');
            }catch(e2){
                alert('Seu IE não suporta AJAX');
                return false;
            }
        }
    }else{
        alert('Seu browser não da suporte ao AJAX')	;
        return false;
    }
    return objAjax;
}
/******************************************************/


function showText(local, file, method, param, async) {
    //referência da div que mostra alguma coisa
    if(async==null)
        async=true;
    var div = document.getElementById(local);
    div.innerHTML = "<img src=\""+loader+"\" alt=\"Carregando...\" />";
    
    //criar o objeto de HTTP
    var obj = MakeObjectHttp();
    
    if(div.obj!=null) {
        div.obj.abort();
    }

    div.obj = obj;
	
    //"abrir a requisição HTTP" chamando o arquivo de processamento
    if (method.toUpperCase() == "GET") {
        file = file + "?" + param;
        param = null;
    }
    obj.open(method, file, async);

    //teste para o objeto http interpretar o envio como se tivesse
    //sido feito por um formulário, que possibilita o envio por post
    if (method.toUpperCase() == "POST") {
        obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded; encoding=iso-8859-1");
    }

    //obj.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
    //obj.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
    //obj.setRequestHeader("Pragma", "no-cache");

    //envia a requisição... 
    //se o method for get o param é null e o envio dos dados é pelo open
    //se o method for post o param é o que foi enviado pela função
    obj.send(param);

    //depois de processado (onreadystatechange)
    //verificar o status e mostrar os dados na DIV
    if(async==true){
        obj.onreadystatechange = function() {
            if (obj.readyState == 4) {
                if (obj.status == 200) {
                    div.style.display = "inline";
                    div.innerHTML = unescape(obj.responseText);
                } else {
                    div.innerHTML = "Status: "+obj.status;
                }
            }
            else {
                //div.innerHTML = "<img src=\""+loader+"\" alt=\"Carregando...\" />";
            }
        }
    } else {
        if (obj.readyState == 4) {
            if (obj.status == 200) {
                div.style.display = "inline";
                div.innerHTML = unescape(obj.responseText);
            } else {
                div.innerHTML = "Status: "+obj.status;
            }
        }
        else {
            //div.innerHTML = "<img src=\""+loader+"\" alt=\"Carregando...\" />";
        }
    }
    div.obj = null;
    return obj;
}