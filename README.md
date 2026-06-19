    - Comando para validar conexão com o banco de Dados

        try {
            DB::connection()->getPdo();
            echo "Conectou com sucesso ao Banco de Dados.";
        } catch (\Throwable $e) {
            echo "Ocorreu um erro na conexão com o Banco de dados: " . $e->getMessage();
        } echo  "Funcionou";

