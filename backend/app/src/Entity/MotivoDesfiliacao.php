<?php
namespace App\Entity;
abstract class MotivoDesfiliacao {
    const INSATISFACAO = 'Insatisfação';
    const FECHAMENTO = 'Fechamento da Empresa';
    const INUTILIDADE = 'Inutilização dos Serviços';
    const FINANCEIRO = 'Financeiro';
    const MUDANCA = 'Mudança de Cidade';
    const ESTRATEGICO = 'Desfiliação Estratégica';
    const POLITICO = 'Politico';
}
?>