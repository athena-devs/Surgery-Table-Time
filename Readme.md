# Surgery Table Time
API desenvolvida para aplicação de mesmo nome que visa entregar os dados de utensilhos e cirurgias visando o auxilio no aprendizado da disciplina de de instrumentador círugico e o vínculo com a enfermagem de modo geral.

## Porque PHP e porque não utilizamos frameworks?
Originalmente se pensava usar uma plataforma de hospedagem que não dava suporte para frameworks, em decorrência disso o projeto não usade tais recursos. Entretanto fora adiconado o uso do composer e pacotes gerenciados pelo mesmo o que facilta o desenvolvimento.

### Descrição Técnica
Aqui buscamos aproximar o desenvolvimento de um modelo MVC, garantindo a sepração de serviços entre entidades e controllers (viewers não planejam serem utilizadas visto que se trata de uma API, há apenas a viewer de home para checagem de disponibilidade do serviço!). Entretanto há a estrtura "Core", onde serviços de banco de dados e gerenciamento de rotas foram implementadas de forma manual. 

Visto que o projeto é open-source a API pode ser utilizada como material de estudo e forkeada para qualquer outra finalidade, pull requests podem ser aprovadas e sua participação seria de grande alegria!