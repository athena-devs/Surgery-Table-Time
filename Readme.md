# Surgery Table Time
API desenvolvida para aplicação de mesmo nome que visa entregar os dados de utensilhos e cirurgias visando o auxilio no aprendizado da disciplina de de instrumentador círugico e o vínculo com a enfermagem de modo geral.

## Porque PHP e porque não utilizamos frameworks?
Visto que a plataforma qual fora selecionada para hospedar a API (InfinityFree), não oferece a robustez de uma VPS, nos sobrou apenas a opção de utilizar serviços básicos em PHP devido a questão de compatibilidade com a plataforma

### Descrição Técnica

Aqui buscamos aproximar o desenvolvimento de um modelo MVC, garantindo a sepração de serviços entre entidades e controllers (viewers não planejam serem utilizadas visto que se trata de uma API, há apenas a viewer de home para checagem de disponibilidade do serviço!). Entretanto há a estrtura "Core", onde serviços de banco de dados e gerenciamento de rotas foram implementadas de forma manual. 

Visto que o projeto é open-source a API pode ser utilizada como material de estudo e forkeada para qualquer outra finalidade, pull requests podem ser aprovadas e sua participação seria de grande alegria!

OBS: O arquivo configure.php é algo próprio do infinityfree, não foi possível infelizmente usar arquivos .env devido a incompatibiliadade da plataforma. Ademais a partir das versões iniciais o código evoluíra para se adequar a plataforma, tendo isto em mente esse não é o ideal para ambientes produtivos de ambito profissional.