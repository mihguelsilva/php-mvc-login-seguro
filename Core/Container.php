<?php
namespace Core;

class Container
{
    private array $instances = [];  // Armazena singletons

    private function resolve(string $class): object
    {
        // 1. Usa Reflection para analisar a classe
        try {
            $reflection = new \ReflectionClass($class);

            // 2. Verifica se a classe pode ser instanciada
            if (!$reflection->isInstantiable()) {
                throw new \Exception("A classe '$class' não pode ser instanciada!");
            }
    
            // 3. Obtém o construtor (se existir)
            $constructor = $reflection->getConstructor();
            if ($constructor === null) {
                return new $class();  // Classe sem dependência
            }
    
            // 4. Resolve cada parâmetro do construtor
            $dependencies = [];
            foreach($constructor->getParameters() as $parameter) {
                $type = $parameter->getType();  // Pega o tipo da dependência (Ex: View)
    
                if ($type === null || $type->isBuiltin()) {
                    throw new \Exception("Não é possível resolver a dependência '{$parameter->getName()}'");
                }
                $dependencies[] = $this->get($type->getName());  // Recursão
            }
    
            // 5. Retorna a nova instância com as dependências injetadas
            return new $class(...$dependencies);
        } catch(\Exception $e)
        {
            throw new \Exception("A classe '$class' não existe!");
        }
    }

    public function singleton(string $key, callable $resolver): void
    {
        $this->instances[$key] = $resolver($this);  // Executa a função e armazena o resultado
    }

    public function get(string $key):object{
        if (isset($this->instances[$key])) {
            return $this->instances[$key];
        }

        // Se não for singleton, cria uma nova instância
        return $this->resolve($key);
    }
}
?>