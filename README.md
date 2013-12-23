MY_Form_validation
==================

Uma extensão para validações dos formulários.

Ajuda a ter mais validações a serem utilizadas com o form_validation.

---

### unique

O metodo is_unique que existe no CI não atende caso esteja fazendo uma atualização dos dados.
O metodo unique verifica se o valor existe na tabela passada.  (ok, o is_unique já faz isso)
No metodo unique tem a opção de passar o valor do id, que dai não faz comparação com o valor do id e somente dos outros, util para quando se esta esta fazendo um update no banco (algo que o is_unique não faz)

por exemplo, em um metodo que irá receber os dados postados, fazer a validação e se tudo ok irá fazer o update na base de dados.

```php
function edit()
{
	$id = $this->input->post('id');
	$confValid = array(
				array('field'	=> 'name',
				      'label'	=> 'Nome',
				      'rules'	=> "required|max_length[100]|trim|unique[user.name.{$id}]"
				      )
				);

	$this->form_validation->set_rules($confValid);
	if($this->form_validation->run() !== FALSE)
	{
		// caso validação ok, faz o update na base de dados
	}
}
```