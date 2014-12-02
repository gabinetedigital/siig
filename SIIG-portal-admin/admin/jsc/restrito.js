/*
Funções gerais de JavaScript
para manipulação das informações e dados
das páginas do administrador
*/

//--------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------

function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function leech(v){
    v=v.replace(/o/gi,"0")
    v=v.replace(/i/gi,"1")
    v=v.replace(/z/gi,"2")
    v=v.replace(/e/gi,"3")
    v=v.replace(/a/gi,"4")
    v=v.replace(/s/gi,"5")
    v=v.replace(/t/gi,"7")
    return v
}

function soNumeros(v){
    return v.replace(/\D/g,"")
}

function data(v) {
    if(v.length>=10)
        return v;
    v=v.replace(/\D/g,"")
    v=v.replace(/^(\d{2})(\d+)/,"$1/$2")
    v=v.replace(/^(\d{2})\/(\d{2})(\d+)/,"$1/$2/$3")
    //    v=v.replace(/^(\d{9})(\d+)/,"$1/$2")
    return v;
}

function hora(v){
    v=v.replace(/\D/g,"")                //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d{2})/,"$1:$2") //Esse é tão fácil que não merece explicações
	//v=v.replace(/^(([0-1]\d|2[0-3]))([0-5])\d/, "$1:$2")
    return v
}

function moeda(v){
    var negativo=false
    if(v.match("^([-])(.*)$"))
        negativo=true
    v=v.replace(/\D/g,"")                    //Remove tudo o que n?o ? d?gito
    //if((v.length-2)<1)
    //  v=v.replace(v, ','+v)
    //else{
    v=v.replace(/(\d+)(\d{5})/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto d?gitos
    v=v.replace(/(\d+)(\d{3})(.)(\d{5})/,"$1.$2$3$4")       //Coloca um ponto entre o terceiro e o quarto d?gitos
    v=v.replace(/(\d+)(\d{3})(.)(\d{3})(.)(\d{5})/,"$1.$2$3$4$5$6")       //Coloca um ponto entre o terceiro e o quarto d?gitos
    v=v.replace(/(\d+)(\d{2})($)/,"$1,$2")       //Coloca um ponto entre o terceiro e o quarto d?gitos*/
    //}

    if(negativo)
        v="-"+v
    
    //v=v.replace(/(\d{*})(\d{2})/,"$1,$2")       //Coloca um ponto entre o terceiro e o quarto d?gitos*/
    return v
}

function telefone(v){
    v=v.replace(/\D/g,"")                 //Remove tudo o que n?o ? d?gito
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca par?nteses em volta dos dois primeiros d?gitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca h?fen entre o quarto e o quinto d?gitos
    return v
}

function cpf(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que n?o ? d?gito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto d?gitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto d?gitos
    //de novo (para o segundo bloco de n?meros)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um h?fen entre o terceiro e o quarto d?gitos
    return v
}

function cepbr(v){
    v=v.replace(/\D/g,"")                //Remove tudo o que n?o ? d?gito
    v=v.replace(/^(\d{5})(\d)/,"$1-$2") //Esse ? t?o f?cil que n?o merece explica??es
    return v
}

function cnpj(v){
    v=v.replace(/\D/g,"")                           //Remove tudo o que n?o ? d?gito
    v=v.replace(/^(\d{2})(\d)/,"$1.$2")             //Coloca ponto entre o segundo e o terceiro d?gitos
    v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") //Coloca ponto entre o quinto e o sexto d?gitos
    v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           //Coloca uma barra entre o oitavo e o nono d?gitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")              //Coloca um h?fen depois do bloco de quatro d?gitos
    return v
}

function romanos(v){
    v=v.toUpperCase()             //Mai?sculas
    v=v.replace(/[^IVXLCDM]/g,"") //Remove tudo o que n?o for I, V, X, L, C, D ou M
    //Essa ? complicada! Copiei daqui: http://www.diveintopython.org/refactoring/refactoring.html
    while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")
        v=v.replace(/.$/,"")
    return v
}

function site(v){
    //Esse sem comentarios para que voc? entenda sozinho ;-)
    v=v.replace(/^http:\/\/?/,"")
    dominio=v
    caminho=""
    if(v.indexOf("/")>-1)
        dominio=v.split("/")[0]
    caminho=v.replace(/[^\/]*/,"")
    dominio=dominio.replace(/[^\w\.\+-:@]/g,"")
    caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,"")
    caminho=caminho.replace(/([\?&])=/,"$1")
    if(caminho!="")dominio=dominio.replace(/\.+$/,"")
    v="http://"+dominio+caminho
    return v
}


//--------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------


//funcao que valida o form de cadastro de justificativa
function valFormCadJustif(form) {
	//se tem motivo
	if (form.mot.value == "") {
		document.getElementById("semtxt").style.display = "block";
		return false;
	}
	else if (form.mot.value == "Outro Motivo Imprev" && form.out.value == "") {
		document.getElementById("semtxt").style.display = "block";
		return false;
	}
	else if (form.arquivo.value == "") {
		document.getElementById("semarq").style.display = "block";
		return false;
	}
	else {
		return true;
	}
}


//funcao que valida o form de cadastro de afastamento
function valFormCadAfast(form) {
	//se tem motivo
	if (form.mot.value == "") {
		document.getElementById("semtxt").style.display = "block";
		return false;
	}
	else if (form.mot.value == "Outro Motivo" && form.out.value == "") {
		document.getElementById("semtxt").style.display = "block";
		return false;
	}
	else {
		return true;
	}
}

//funçao que autocompleta as horas do cadastro de afastamento
function fillHour(obj) {
	var txt = obj.value;
	//var exh = /^([0-1]\d|2[0-3]):[0-5]\d$/;
	var exh = /^\d{2}:\d{2}$/;
	if (!txt.match(exh)) {
		if (txt.length == 3) 
			txt = txt.substr(0,2);
		txt = txt.replace(/^(\d{2})/,"$1:00");
	}
	obj.value = txt;
}


//função que pergunta se quer deletar a publicação cadastrada
function deletePub(idp, pub) {
	ok = confirm("Tem certeza que deseja excluir a publicação \n"+pub+"?");
	if (ok) {
		location.href = "publicacoes-exec.php?act=delete&idp="+idp;
	}
}

//função mostra e esoconde divs
function showHide(div)
{
	if (document.getElementById(div).style.display != "none") {
		document.getElementById(div).style.display = "none";
	} else {
		document.getElementById(div).style.display = "inline";
	}
}

//funcao que esconde uma div
function hide(div)
{
	document.getElementById(div).style.display = "none";
}

//funcao que mostra uma div
function show(div)
{
	document.getElementById(div).style.display = "inline";
}
function show2(val)
{
	if (val == "Outro Motivo") {
		document.getElementById("outmot").style.display = "inline";
	}
}

//função que mostra os dados no rodapé
function showAddress(div){
	var txt = document.getElementById(div).innerHTML;
	document.getElementById("texto").innerHTML = txt;
}


//funçao que direciona para exclusão
function deleteIns(pag) {
	ok = confirm("Tem certeza que deseja CANCELAR essa INSCRIÇÃO?");
	if (ok) {
		location.href = pag;
	}
}


/* *************** FUNÇÕES ADMIN SIIG *************** */

//funçao que pergunta se deseja ativar estado
function ativarEstado(cod,act){
    ok = confirm("Você tem certeza que deseja ativar o estado?");
    if (ok) {
        document.location.href = "estados-exec.php?act="+act+"&id="+cod;
    }   
}

//funçao que pergunta se deseja desativar estado
function desativarEstado(cod,act){
    ok = confirm("Você tem certeza que deseja desativar o estado?");
    if (ok) {
        document.location.href = "estados-exec.php?act="+act+"&id="+cod;
    }   
}

//funçao que pergunta se deseja excluir estado
function excluirEstado(cod,act){
    ok = confirm("Você tem certeza que deseja excluir o estado?");
    if (ok) {
        document.location.href = "estados-exec.php?act="+act+"&id="+cod;
    }   
}

//funçao que pergunta se deseja ativar cidade
function ativarCidade(cod,act){
    ok = confirm("Você tem certeza que deseja ativar a cidade?");
    if (ok) {
        document.location.href = "cidades-exec.php?act="+act+"&id="+cod;
    }   
}

//funçao que pergunta se deseja desativar cidade
function desativarCidade(cod,act){
    ok = confirm("Você tem certeza que deseja desativar a cidade?");
    if (ok) {
        document.location.href = "cidades-exec.php?act="+act+"&id="+cod;
    }   
}

//funçao que pergunta se deseja excluir cidade
function excluirCidade(cod,act){
    ok = confirm("Você tem certeza que deseja excluir a cidade?");
    if (ok) {
        document.location.href = "cidades-exec.php?act="+act+"&id="+cod;
    }   
}


//funçao que pergunta se deseja ativar categoria
function ativarCategoria(cod,act){
    ok = confirm("Você tem certeza que deseja ativar a categoria?");
    if (ok) {
        document.location.href = "categorias-exec.php?act="+act+"&id="+cod;
    }   
}

//funçao que pergunta se deseja desativar categoria
function desativarCategoria(cod,act){
    ok = confirm("Você tem certeza que deseja desativar a categoria?");
    if (ok) {
        document.location.href = "categorias-exec.php?act="+act+"&id="+cod;
    }   
}

//funçao que pergunta se deseja excluir categoria
function excluirCategoria(cod,act){
    ok = confirm("Você tem certeza que deseja excluir a categoria?");
    if (ok) {
        document.location.href = "categorias-exec.php?act="+act+"&id="+cod;
    }   
}


//funçao que pergunta se deseja ativar subcategoria
function ativarSubcategoria(cod,act){
    ok = confirm("Você tem certeza que deseja ativar a subcategoria?");
    if (ok) {
        document.location.href = "subcategorias-exec.php?act="+act+"&id="+cod;
    }   
}

//funçao que pergunta se deseja desativar subcategoria
function desativarSubcategoria(cod,act){
    ok = confirm("Você tem certeza que deseja desativar a subcategoria?");
    if (ok) {
        document.location.href = "subcategorias-exec.php?act="+act+"&id="+cod;
    }   
}

//funçao que pergunta se deseja excluir subcategoria
function excluirSubcategoria(cod,act){
    ok = confirm("Você tem certeza que deseja excluir a subcategoria?");
    if (ok) {
        document.location.href = "subcategorias-exec.php?act="+act+"&id="+cod;
    }   
}


function ativarEvento(cod,act){
    ok = confirm("Você tem certeza que deseja ativar o evento?");
    if (ok) {
        document.location.href = "eventos-exec.php?act="+act+"&id="+cod;
    }   
}

//funçao que pergunta se deseja desativar subcategoria
function desativarEvento(cod,act){
    ok = confirm("Você tem certeza que deseja desativar o evento?");
    if (ok) {
        document.location.href = "eventos-exec.php?act="+act+"&id="+cod;
    }   
}

//funçao que pergunta se deseja excluir subcategoria
function excluirEvento(cod,act){
    ok = confirm("Você tem certeza que deseja excluir o evento?");
    if (ok) {
        document.location.href = "eventos-exec.php?act="+act+"&id="+cod;
    }   
}