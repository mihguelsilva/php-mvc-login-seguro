<?php
namespace App\Controllers\Site;

use \Core\{Controller, Mailer};
use \App\Models\MensagemContato;
use \App\Helpers\{Csrf, Flash, Sanitize, TemplateEngine};

class ContatoController extends Controller
{
    public function __construct(private \App\Core\SessionManager $session, private MensagemContato $mensagemContato) {}

    public function get():void
    {
        $this->view('contato');
    }

    public function send(): void
    {
        if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
            die('Erro de validação');
        }

        $nome = Sanitize::string($_POST['nome']) ?? '';
        $email = Sanitize::email($_POST['email']) ?? '';
        $assunto = Sanitize::string($_POST['assunto']) ?? '';
        $mensagem = Sanitize::string($_POST['mensagem']) ?? '';

        if (empty($nome) || empty($email) || empty($mensagem)) {
            Flash::set('error', 'Preencha todos os campos obrigatórios');
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
            Flash::set('success', 'Mensagem enviada com sucesso!');
        } else {
            Flash::set('error', 'Erro ao enviar mensagem. Tente novamente mais tarde');
        }
        header('Location: /contato');
        exit();
    }
}
?>