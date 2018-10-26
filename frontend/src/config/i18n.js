export default {
  pt_BR: {
    login: {
      signin: 'Entrar',
      forgot: 'esqueceu sua senha ?'
    },
    labels: {
      email: 'E-mail',
      password: 'Senha',
      password_confirmation: 'Confirmar senha',
      name: 'Nome',
      phone: 'Telefone',
      image: 'Imagem',
      actions: 'Ações',
      id: 'Id',
      creator: 'Criador (a)',
      observations: 'Observações',
      description: 'Descrição',
      price: 'Preço',
      buy_price: 'Preço de Compra',
      sell_price: 'Preço de Venda',
      stock: 'Estoque',
      provider: 'Fornecedor',
      selected: 'Selecionado',
      select: 'Pressione enter para selecionar',
    },
    placeholders: {
      email: 'Digite seu e-mail aqui',
      password: 'Digite a senha aqui',
      password_confirmation: 'Confirme a senha aqui',
      name: 'Digite o nome aqui',
      phone: 'Digite o telefone aqui',
      noData: 'nenhum registro encontrado...',
      observations: 'Digite aqui algumas observações...',
      description: 'Digite uma descrição aqui...',
      provider: 'Escolha um fornecedor...',
      unable_to_remove: 'Não é possivel remover esta opção',
      search: 'digite para pesquisar...',
      no_result: 'Nenhum resultado encontrado, verifique se as palavras estão escritas corretamente'
    },
    notifications: {
      title: {
        error: 'Ops!',
        success: 'Sucesso!',
        wait: 'Aguarde!',
        confirm: 'Confirme!',
        user: {
          verifyPassword: 'Verificar Senha'
        },
      },
      message: {
        error: 'Ocorreu um erro inesperado...',
        unauthorized: 'Você não tem autorização para isso...',
        validation: 'Há algo errado com os dados informados, tente novamente...',
        missing: 'Você não se esqueceu de nada ? {field}',
        user: {
          update: {
            error: 'Ocorreu um erro ao atualizar suas informações',
            success: 'Seu perfil foi atualizado com sucesso'
          },
          create: {
            success: 'O usuário foi cadastrado com sucesso, vamos redireciona-lo para pagina de usuários...',
            wait: 'Vamos começar o processo para cadastrar o usuário, isso pode levar alguns segundos...'
          },
          delete: {
            confirm: 'Tem certeza que deseja apagar este usuário ?',
            success: 'Usuário apagado com sucesso!'
          },
          restore: {
            confirm: 'Tem certeza que deseja restaurar este usuário ?',
            success: 'Usuário restaurado com sucesso!'
          }
        },
        client: {
          disable: {
            confirm: 'Tem certeza que deseja desativar este usuário ?',
            success: 'Usuário desativado com sucesso!'
          },
          enable: {
            confirm: 'Tem certeza que deseja ativar este usuário ?',
            success: 'Usuário ativado com sucesso!'
          }
        },
        customer: {
          create: {
            success: 'O cliente foi cadastrado com sucesso, vamos redireciona-lo para a pagina de clientes...',
            wait: 'Vamos começar o processo para cadastrar o cliente, isso pode levar alguns segundos...'
          },
          edit: {
            success: 'O cliente foi editado com sucesso, vamos redireciona-lo para a pagina de clientes...',
            wait: 'Vamos começar o processo para editar o cliente, isso pode levar alguns segundos...'
          },
          delete: {
            success: 'O cliente foi apagado com sucesso...',
            confirm: 'Tem certeza que deseja apagar este cliente ?'
          },
          restore: {
            success: 'O cliente foi restaurado com sucesso...',
            confirm: 'Tem certeza que deseja restaurar este cliente ?'
          }
        },
        provider: {
          create: {
            success: 'O fornecedor foi cadastrado com sucesso, vamos redireciona-lo para a pagina de fornecedores...',
            wait: 'Vamos começar o processo para cadastrar o fornecedor, isso pode levar alguns segundos...'
          },
          edit: {
            success: 'O fornecedor foi editado com sucesso, vamos redireciona-lo para a pagina de fornecedores...',
            wait: 'Vamos começar o processo para editar o fornecedor, isso pode levar alguns segundos...'
          },
          delete: {
            success: 'O fornecedor foi apagado com sucesso...',
            confirm: 'Tem certeza que deseja apagar este fornecedor ?'
          },
          restore: {
            success: 'O fornecedor foi restaurado com sucesso...',
            confirm: 'Tem certeza que deseja restaurar este fornecedor ?'
          }
        },
        product: {
          create: {
            success: 'O produto foi cadastrado com sucesso, vamos redireciona-lo para a pagina de produtos...',
            wait: 'Vamos começar o processo para cadastrar o produto, isso pode levar alguns segundos...'
          },
          edit: {
            success: 'O produto foi editado com sucesso, vamos redireciona-lo para a pagina de produtos...',
            wait: 'Vamos começar o processo para editar o produto, isso pode levar alguns segundos...'
          },
          delete: {
            success: 'O produto foi apagado com sucesso...',
            confirm: 'Tem certeza que deseja apagar este produto ?'
          },
          restore: {
            success: 'O produto foi restaurado com sucesso...',
            confirm: 'Tem certeza que deseja restaurar este produto ?'
          }
        },
        paymentType: {
          create: {
            success: 'O método de pagamento foi cadastrado com sucesso, vamos redireciona-lo para a pagina de método de pagamentoes...',
            wait: 'Vamos começar o processo para cadastrar o método de pagamento, isso pode levar alguns segundos...'
          },
          edit: {
            success: 'O método de pagamento foi editado com sucesso, vamos redireciona-lo para a pagina de método de pagamentoes...',
            wait: 'Vamos começar o processo para editar o método de pagamento, isso pode levar alguns segundos...'
          },
          delete: {
            success: 'O método de pagamento foi apagado com sucesso...',
            confirm: 'Tem certeza que deseja apagar este método de pagamento ?'
          },
          restore: {
            success: 'O método de pagamento foi restaurado com sucesso...',
            confirm: 'Tem certeza que deseja restaurar este método de pagamento ?'
          }
        },
      }
    },
    validation: {
      invalid_image: 'Por favor selecione um arquivo do tipo imagem',
      unsuported_file_reader: 'Não é possivel selecionar uma imagem neste navegador'
    },
    pages: {
      home: 'Home',
      login: 'Entrar',
      profile: 'Perfil',
      configurations: 'Configurações',
      users: 'Usuários',
      createUsers: 'Cadastrar Usuários',
      trashedUsers: 'Usuários Apagados',
      clients: 'Clientes',
      disabledClients: 'Clientes Desativados',
      customers: 'Clientes',
      createCustomers: 'Cadastrar Cliente',
      trashedCustomers: 'Clientes Apagados',
      editCustomers: 'Editar Cliente',
      providers: 'Fornecedores',
      createProviders: 'Cadastrar Fornecedor',
      trashedProviders: 'Fornecedores Apagados',
      editProviders: 'Editar Fornecedor',
      paymentTypes: 'Métodos de Pagamento',
      createPaymentTypes: 'Cadastrar Método de Pagamento',
      trashedPaymentTypes: 'Métodos de Pagamento Apagados',
      editPaymentTypes: 'Editar Método de Pagamento',
      payments: 'Mét. Pagamentos',
      products: 'Produtos',
      createProducts: 'Cadastrar Produto',
      trashedProducts: 'Produtos Apagados',
      editProducts: 'Editar Produto',
    }
  }
}