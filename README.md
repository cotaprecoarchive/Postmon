# `CotaPreco\Postmon` [![Build Status](https://travis-ci.org/CotaPreco/Postmon.svg)](https://travis-ci.org/CotaPreco/Postmon)

```PHP
use CotaPreco\Postmon\Cep;
use CotaPreco\Postmon\Postmon;

$postmon = new Postmon();

/* @var CotaPreco\Postmon\PartialAddress $address */
$address = $postmon->findAddressByCep(Cep::fromString('<cep>'));

```
Qualquer requisição na API sempre irá retornar um [`PartialAddress`](https://github.com/CotaPreco/Postmon/blob/master/src/CotaPreco/Postmon/PartialAddress.php), independente de conter todos os campos para um endereço na resposta da API do Postmon.

- **PartialAddress** é serializável para JSON *`implements JsonSerializable`*, então: `json_encode($address)` é absolutamente possível;
- Campos com o valor `null` (campos que não estão presentes na resposta da API) são omitidos da serialização para JSON;
- `@throws CepNotFoundException` para qualquer resposta da API que o código de status HTTP seja diferente de **200** &mdash; [talvez você queira melhorar isso daqui](https://github.com/CotaPreco/Postmon/pulls).

## Sim, o composer.
```
$ composer require cotapreco/postmon dev-master
```

## License
[MIT License](https://raw.githubusercontent.com/CotaPreco/Postmon/master/LICENSE) © Cota Preço, 2015.
