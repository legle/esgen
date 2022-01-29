<?php
function p($name = "", $value = "")
{
    if (isset($_POST[$name])) {
        if (empty($_POST[$name])) {
            return ($value);
        } else {
            return (strip_tags($_POST[$name]));
        }
    }
    return (false);
}

function c($name = "", $value = "", $label = "", $type = "text")
{
    if (p($name)) {
        return (p($name));
    } else {
        return ("<input type=\"{$type}\" name=\"{$name}\" aria-label=\"{$label}\" value=\"{$value}\" />");
    }
}

$nome = c("nome", "Fulano de Tal", "Nome: ");
$funcao = c("funcao", "Webdesigner", "Fun&ccedil;&atilde;o: ");
$setor = c("setor", "Desenvolvimento de Aplicativos", "Setor: ");
$email = c("email", "Fulano.tal@example.tld", "Email: ", "email");
$telefone = c("telefone", "(11) 1234-4321", "Telefone: ");
$celular = c("celular", "(11) 91234-4321", "Celular: ");
$endereco = c("endereco", "Rua do Seu Trabalho, 1234", "Endere&ccedil;o");
$btn = "";
$type = "text";
foreach ($_POST as $k => $v) {
    $$k = $v;
}
$file = "log.csv";
if (file_exists($file)) {
    if (is_writable($file)) {
        $fp = fopen($file, "a+");
        fwrite($fp, "{$nome};{$funcao};{$setor};{$email};{$telefone};{$celular};{$endereco}\n");
        fclose($fp);
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>

<HEAD>
    <TITLE>Simple Email Signature Generator</TITLE>
    <meta charset="iso-8859-1" />
</HEAD>

<BODY style="font-family:Verdana, Helvetica, sans-serif;">
    <form method="post" action="index.php">
        <?php if (p("btn") == "") { ?>
            <div id="assinatura"><?php include("modelo.html"); ?></div>
            <input type="submit" name="btn" value="Gerar" />
        <?php } else { ?>
            <div id="assinatura" contenteditable="true" tabindex="0"><?php include("modelo.html"); ?></div>
            <button id="copy" onClick="return(false)">Clique aqui para copiar a sua assinatura e cole na pr&oacute;xima p&aacute;gina</button>
            <script type="text/javascript">
                let btn = document.querySelector('#copy');
                btn.addEventListener('click', function(e) {
                    let textArea = document.querySelector('#assinatura');
                    textArea.focus();
                    document.execCommand('selectAll');
                    document.execCommand('copy');
                    document.location.href = "https://outlook.office365.com/mail/options/mail/messageContent/signature";
                });
            </script>
        <?php } ?>
        </p>
    </form>
</BODY>

</HTML>