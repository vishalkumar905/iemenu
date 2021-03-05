<?php

class OrderModel extends CI_Model
{
	private $tableName = 'orders';
	private $primaryKey = 'id';
    private $columnSearch = array('productCode', 'productName'); //set column field database for datatable searchable 
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getTable()
	{
		return $this->tableName;
	}
	
	public function get($orderBy)
	{
		$this->db->order_by($orderBy);
		$query=$this->db->get($this->tableName);
		return $query;
	}
	
	public function getWithLimit($limit, $offset, $orderBy)
	{
		$this->db->limit($limit, $offset);
		$this->db->order_by($orderBy);
		$query=$this->db->get($this->tableName);
		return $query;
	}
	
	public function getWhere($id)
	{
		$this->db->where($this->primaryKey, $id);
		$query=$this->db->get($this->tableName);
		return $query;
	}
	
	public function getWhereCustom($columns = '*', $condition = null, $orderBy = null, $whereIn = null, $like = null, $limit = null, $offset = null)
	{
		$this->db->select($columns);
		
		if (!empty($condition))
		{
			$this->db->where($condition);
		}
		
		if (!empty($whereIn['field']) && !empty($whereIn['values']))
		{
			$this->db->where_in($whereIn['field'], $whereIn['values']);
		}
		
		if (!empty($like['fields']) && !empty($like['search']) && !empty($like['side']) && is_array($like['fields']))
		{
			foreach ($like['fields'] as $key => $field)
			{
				if ($key == 0) 
				{
					$this->db->group_start();
					$this->db->like($field, $like['search'], $like['side']);
				}
				else
				{
					$this->db->or_like($field, $like['search'], $like['side']);
				}

				
				if (($key + 1) == count($like['fields']))
				{
					$this->db->group_end();
				}
			}
		}

		if (!empty($orderBy['field']) && !empty($orderBy['type']))
		{
			$this->db->order_by($orderBy['field'], $orderBy['type']);
		}

		if ($limit > 0 && $offset >= 0)
		{
			$this->db->limit($limit, $offset);
		}

		$query = $this->db->get($this->tableName);
		return $query;
	}

	public function getWhereCustomCount($condition = null, $whereIn = null, $like = null)
	{
		$this->db->select(['count(id) as totalCount']);
		
		if (!empty($condition))
		{
			$this->db->where($condition);
		}
		
		if (!empty($whereIn['field']) && !empty($whereIn['values']))
		{
			$this->db->where_in($whereIn['field'], $whereIn['values']);
		}
		
		if (!empty($like['fields']) && !empty($like['search']) && !empty($like['side']) && is_array($like['fields']))
		{
			foreach ($like['fields'] as $key => $field)
			{
				if ($key == 0) 
				{
					$this->db->group_start();
					$this->db->like($field, $like['search'], $like['side']);
				}
				else
				{
					$this->db->or_like($field, $like['search'], $like['side']);
				}

				
				if (($key + 1) == count($like['fields']))
				{
					$this->db->group_end();
				}
			}
		}

		$query = $this->db->get($this->tableName);
		return $query;
	}
	
	public function insert($data)
	{
		$data['createdOn'] = time();
		if($this->db->insert($this->tableName, $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
	
	public function update($id, $data)
	{
		$this->db->where($this->primaryKey, $id);
		$this->db->update($this->tableName, $data);
		return true;
	}

	public function updateWithCustom($data, $condition)
	{
		$this->db->where($condition);
		$this->db->update($this->tableName, $data);
	}
	
	public function delete($id)
	{
		$this->db->where($this->primaryKey, $id);
		$this->db->delete($this->tableName);
	}
	
	public function countWhere($column, $value)
	{
		$this->db->where($column, $value);
		$query=$this->db->get($this->tableName);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	public function countAll()
	{
		$query=$this->db->get($this->tableName);
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	public function getCountWithCustom($condition)
	{
		$this->db->where($condition);
		$query=$this->db->get($this->tableName);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	public function getMax()
	{
		$this->db->select_max($this->primaryKey);
		$query = $this->db->get($this->tableName);
		$row=$query->row();
		$primaryKey = $this->primaryKey;
		$id=$row->$primaryKey;
		return $id;
	}
	
	public function customQuery($mysqlQuery)
	{
		$query = $this->db->query($mysqlQuery);
		return $query;
    }
    
    public function getSubOrders($orderId, $id = 0)
	{
		// id: For single order details
		if ($id > 0)
		{
			$condition = [
				'id' => $id
			];
		}
		else
		{
			$condition = [
				'order_id' => $orderId,
				'res_id' => $this->session->userid
			];
		}

		return $this->db->select('*')->from('sub_orders')->where($condition)->get()->result_array();
	}

	public function getOrderRevenuByPaymentModes($restaurantId, $orderStatus, $startDate = NULL, $endDate = NULL, $today = NULL)
	{
		$columns = [
			sprintf("SUM(CASE WHEN o.payment_mode = %s THEN o.total ELSE 0 END) + SUM(CASE WHEN o.amountPaidByCash IS NOT NULL THEN o.amountPaidByCash ELSE 0 END) + SUM(CASE WHEN so.payment_mode = %s THEN so.total ELSE 0 END) + SUM(CASE WHEN so.amountPaidByCash IS NOT NULL THEN so.amountPaidByCash ELSE 0 END) as totalPaymentByCash", PAYEMENT_MODE_CASH, PAYEMENT_MODE_CASH),
			sprintf("SUM(CASE WHEN o.payment_mode = %s THEN o.total ELSE 0 END) + SUM(CASE WHEN o.amountPaidByOnline IS NOT NULL THEN o.amountPaidByOnline ELSE 0 END) + SUM(CASE WHEN so.payment_mode = %s THEN so.total ELSE 0 END) + SUM(CASE WHEN so.amountPaidByOnline IS NOT NULL THEN so.amountPaidByOnline ELSE 0 END) as totalPaymentByOnline", PAYEMENT_MODE_ONLINE, PAYEMENT_MODE_ONLINE),
			sprintf("SUM(CASE WHEN o.payment_mode = %s THEN o.total ELSE 0 END) + SUM(CASE WHEN o.amountPaidByUpi IS NOT NULL THEN o.amountPaidByUpi ELSE 0 END) + SUM(CASE WHEN so.payment_mode = %s THEN so.total ELSE 0 END) + SUM(CASE WHEN so.amountPaidByUpi IS NOT NULL THEN so.amountPaidByUpi ELSE 0 END) as totalPaymentByUpi", PAYEMENT_MODE_UPI, PAYEMENT_MODE_UPI),
			sprintf("SUM(CASE WHEN o.payment_mode = %s THEN o.total ELSE 0 END) + SUM(CASE WHEN o.amountPaidByCard IS NOT NULL THEN o.amountPaidByCard ELSE 0 END) + SUM(CASE WHEN so.payment_mode = %s THEN so.total ELSE 0 END) + SUM(CASE WHEN so.amountPaidByCard IS NOT NULL THEN so.amountPaidByCard ELSE 0 END) as totalPaymentByCard", PAYEMENT_MODE_CARD, PAYEMENT_MODE_CARD),
			sprintf("SUM(CASE WHEN o.payment_mode = %s THEN o.total ELSE 0 END) + SUM(CASE WHEN o.amountPaidByBtc IS NOT NULL THEN o.amountPaidByBtc ELSE 0 END) + SUM(CASE WHEN so.payment_mode = %s THEN so.total ELSE 0 END) + SUM(CASE WHEN so.amountPaidByBtc IS NOT NULL THEN so.amountPaidByBtc ELSE 0 END) as totalPaymentByBtc", PAYEMENT_MODE_BTC, PAYEMENT_MODE_BTC),
			sprintf("SUM(CASE WHEN o.payment_mode = %s THEN o.total ELSE 0 END) + SUM(CASE WHEN o.amountPaidBySwiggy IS NOT NULL THEN o.amountPaidBySwiggy ELSE 0 END) + SUM(CASE WHEN so.payment_mode = %s THEN so.total ELSE 0 END) + SUM(CASE WHEN so.amountPaidBySwiggy IS NOT NULL THEN so.amountPaidBySwiggy ELSE 0 END) as totalPaymentBySwiggy", PAYEMENT_MODE_SWIGGY, PAYEMENT_MODE_SWIGGY),
			sprintf("SUM(CASE WHEN o.payment_mode = %s THEN o.total ELSE 0 END) + SUM(CASE WHEN o.amountPaidByZomato IS NOT NULL THEN o.amountPaidByZomato ELSE 0 END) + SUM(CASE WHEN so.payment_mode = %s THEN so.total ELSE 0 END) + SUM(CASE WHEN so.amountPaidByZomato IS NOT NULL THEN so.amountPaidByZomato ELSE 0 END) as totalPaymentByZomato", PAYEMENT_MODE_ZOMATO, PAYEMENT_MODE_ZOMATO),
			sprintf("SUM(CASE WHEN o.payment_mode = %s THEN o.total ELSE 0 END) + SUM(CASE WHEN o.amountPaidByMagicPin IS NOT NULL THEN o.amountPaidByMagicPin ELSE 0 END) + SUM(CASE WHEN so.payment_mode = %s THEN so.total ELSE 0 END) + SUM(CASE WHEN so.amountPaidByMagicPin IS NOT NULL THEN so.amountPaidByMagicPin ELSE 0 END) as totalPaymentByMagicPin", PAYEMENT_MODE_MAGIC_PIN, PAYEMENT_MODE_MAGIC_PIN),
		];

		$condition = [
			'o.res_id' => $restaurantId,
			'o.order_status' => $orderStatus
		];
		
		if (!empty($startDate) && $startDate != 'NaN')
		{
			$condition[sprintf('DATE(o.created_at) >= "%s"', $startDate)] = NULL;
		}

		if (!empty($endDate) && $endDate != 'NaN')
		{
			$condition[sprintf('DATE(o.created_at) <= "%s"', $endDate)] = NULL;
		}

		if (!is_null($today) && $today == true)
		{
			$condition['DATE(o.created_at)'] = date('Y-m-d');
		}

		return $this->db->select($columns)->from('orders o')->join('sub_orders so', 'so.order_id = o.id', 'left')->where($condition)->get()->row_array();
	}
}

?>