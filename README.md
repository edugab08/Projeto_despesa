O Gerenciador de Despesas é um sistema web desenvolvido em Laravel com o objetivo de gerenciar receitas, despesas e investimentos pessoais, oferecendo uma interface para controle financeiro e análise de saldos mensais, anuais e de gastos futuros.

Durante o desenvolvimento, foram aplicados padrões de projeto e princípios de arquitetura de software para tornar o código mais modular, reutilizável e fácil de manter. O padrão Factory Method foi utilizado para centralizar a criação de transações, garantindo consistência e flexibilidade na adição de novos tipos. O projeto utiliza o padrão Strategy para realizar diferentes tipos de cálculos financeiros de forma flexível e independente. Cada estratégia implementa a interface CalculoSaldoStrategy, garantindo que todas possuam o mesmo método de cálculo, mas com comportamentos distintos.

A CalculoMensalStrategy é responsável por calcular o saldo das transações realizadas dentro do mês atual, permitindo ao usuário acompanhar sua movimentação financeira mensal.
A CalculoAnualStrategy realiza o cálculo do saldo considerando todas as transações registradas ao longo do ano, fornecendo uma visão mais ampla do desempenho financeiro anual.
Já a CalculoGastosFuturosStrategy soma os valores estimados de gastos planejados para períodos futuros, auxiliando no controle e previsão orçamentária.

Essas três estratégias, aplicadas de forma independente e intercambiável, tornam o sistema mais modular e de fácil manutenção, permitindo incluir novos tipos de cálculo sem modificar o código existente.

Também foram adotados os princípios SOLID, como a responsabilidade única, o aberto/fechado e a inversão de dependência, assegurando que cada classe tenha uma função específica e que as dependências sejam baseadas em abstrações. Essas práticas resultaram em um código mais limpo, flexível e preparado para futuras evoluções.
