<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    /**
    * constructor method
    */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }


    /**
	 * Unique
	 *
	 * Verifica se o valor já está cadastrado no banco
	 * unique[users.login] retorna FALSE se o valor postado já estiver no campo login da tabela users
	 * unique[users.login.10] retorna FALSE se o valor postado já estiver no campo login da tabela users, desde que o id seja diferente de 10.
	 * 						isso é útil quando for atualizar os dados
	 * unique[users.city.10:id_cidade] retorna FALSE se o valor postado já estiver no campo city da tabela users, desde que o id_cidade seja diferente de 10.
	 *						se não for passado o valor após o : será usado o id.
	 * @access	public
	 * @param	string - dados que será buscado
	 * @param	string - campo, tabela e id
	 *
	 * @return	bool
	 */
	public function unique($str = '', $field = '')
	{
		$CI =& get_instance();
		
		$res = explode('.', $field, 3);
		
		$table	= $res[0];
		$column	= $res[1];
 
		$CI->db
			->select('COUNT(*) as total')
			->where($column, $str);
		
		if( isset($res[2]) )
		{
			$res2 = explode(':', $res[2], 2);
			
			$ignore_value = $res2[0];			
			$ignore_field = isset($res2[1]) ? $res2[1] : 'id';

			$CI->db->where($ignore_field . ' !=', $ignore_value);
		}
 
		$total = $CI->db->get($table)->row()->total;
		return ($total > 0) ? FALSE : TRUE;
	}


    
}

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */