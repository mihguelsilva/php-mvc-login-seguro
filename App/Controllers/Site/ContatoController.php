<?php
namespace App\Controllers\Site;

use \Core\{Controller, Mailer};
use \App\Models\MensagemContato;
use \App\Helpers\{Csrf, Flash, Sanitize, TemplateEngine};

class ContatoController
{
    public function __construct(
        private MensagemContato $mensagemContato,
        private Csrf $csrf, 
        private Flash $flash,
        private Controller $controller
        ) {}

    public function get(): string
    {
        return $this->controller->view('contato', [
            'display' => $this->flash->display(),
            'csrf' => $this->csrf->getTokenInput()
        ]);
    }

    public function send(): void
    {
        $this->csrf->verifyToken(htmlspecialchars($_POST['csrf_token']));

        $nome = Sanitize::string($_POST['nome']) ?? '';
        $email = Sanitize::email($_POST['email']) ?? '';
        $assunto = Sanitize::string($_POST['assunto']) ?? '';
        $mensagem = Sanitize::string($_POST['mensagem']) ?? '';

        if (empty($nome) || empty($email) || empty($mensagem)) {
            $this->flash->set('error', 'Preencha todos os campos obrigatórios');
            return;
        }

        $array = array(
            'nome' => htmlspecialchars($nome),
            'email' => htmlspecialchars($email),
            'mensagem' => nl2br(htmlspecialchars($mensagem))
        );
        $file = ROOT_DIR.DS.'static'.DS.'html'.DS.'email_message.html';

        $body = TemplateEngine::render($file, $array);

        $enviado = Mailer::send($_ENV['MAIL_TO'], $assunto, $body);

        if ($enviado) {
            $this->mensagemContato->salvar([
                "nome"=>$nome,
                "email"=>$email,
                "assunto"=>$assunto,
                "mensagem"=>$mensagem
            ]);
            $this->flash->set('success', 'Mensagem enviada com sucesso!');
        } else {
            $this->flash->set('error', 'Erro ao enviar mensagem. Tente novamente mais tarde');
        }
        header('Location: /contato');
        exit();
    }
}
?>