<?php
/************************************************************************************************
*												*
*	A simple, not very well writen class, which manages dynamic double-linked list		*
*	structure of data. Not well tested, so if u find an errors and if u have better		*
*	ideas how to be written such a thing, mail me to ggeorgiev@ikode.com.			*
*												*
*	Georgi Georgiev, 04.2001, Varna, BG							*
*												*
*************************************************************************************************/
// Data control structure
class node {
	var $id=""; // Number of the the coresponding element from an array
	var $prev=""; // Previous number
	var $next=""; // Next Number
	var $data; // Node data
	function node($did, $p, $n, $dta)
	{
		// Initalize main node structure
		// _ index prefix is given cause of protection
		// of mixing array keys
		$this->id=$did;
		$this->prev=$p;
		$this->next=$n;
		$this->data=$dta;
	}
}
// Dynamic Double-linked List
class dlist {
	var $db_list=array(); // Indexed Array, which will store list nodes
	var $fid=""; // First element from DLIST (initialized as NULL)
	var $lid=""; // Last element from DLIST (initialized as NULL)
	function GetPrev($id)
	{
		// Gets the index of the previous node related to given node (if exists)
		if ($this->db_list[$id]->prev) return $this->db_list[$id]->prev;
		return FALSE;
	}
	function GetNext($id)
	{
		// Gets the index of the next node related to given node (if exists)
		if ($this->db_list[$id]->next) return $this->db_list[$id]->next;
		return FALSE;
	}
	function GetData($id)
	{
		// Gets DATA filed from given node
                if ($this->db_list[$id]->data) return $this->db_list[$id]->data;
                return FALSE;
	}
        function AddNode($id, $pid, $nid, $data)
        {
		// Adds node to DLIST
		// Syntax:
		// AddNode ($node_name, $previous_node_name, $next_node_name, $data)
		if ($this->db_list[$id]) return FALSE; // Checks if node exists
		if (!$this->fid)
		{
			$this->fid=$id;
			$pid=$nid="";
		}
		elseif ((!$this->lid)&&($this->fid))
		{
			$this->lid=$id;
			$nid="";
			$pid=$this->fid;
			$this->db_list[$pid]->next=$id;
		}
		elseif ((($pid)||($nid))&&($this->fid)&&($this->lid))
		{
			if ($this->db_list[$pid])
			{
				if ($this->GetNext($pid))
				{
					$nid=$this->GetNext($pid);
					$this->db_list[$nid]->prev=$id;
				}
				else
				{
					$nid="";
					$this->lid=$id;
				}
				$this->db_list[$pid]->next=$id;
			}
			else
			{
                        	if (!$this->db_list[$nid]) return FALSE;
                        	if ($this->GetPrev($nid))
				{
					$pid=$this->GetPrev($nid);
					$this->db_list[$pid]->next=$id;
				}
                        	else
                        	{
                                	$pid="";
                                	$this->fid=$id;
                        	}
                        	$this->db_list[$nid]->prev=$id;
			}
		}
		else return FALSE;
                $this->db_list[$id]=new node($id, $pid, $nid, $data);
                return TRUE;
        }
	function DelNode($id)
	{
		// Removes node from DLIST
		// Syntax:
		// DelNode ($node_name)
		if (!$this->db_list[$id]) return FALSE;
		if ($id==$this->fid)
		{
			$this->fid=($this->GetNext($id))?$this->GetNext($id):"";
			if ($this->lid==$this->GetNext($id)) $this->lid="";
		}
		elseif ($id==$this->lid)
			$this->lid=($this->GetPrev($id)==$this->fid)?"":$this->GetPrev($id);
		if ($this->db_list[$this->GetPrev($id)]->next)
			$this->db_list[$this->GetPrev($id)]->next=$this->GetNext($id);
		if ($this->db_list[$this->GetNext($id)]->prev)
			$this->db_list[$this->GetNext($id)]->prev=$this->GetPrev($id);
		$this->db_list[$id]="";
	}
}

/*

//Short example

	// Let us create DLIST
	$d=new dlist;
	$d->AddNode ("first", "", "", "This is and will always be the first element");
	$d->AddNode ("unknown", "", "", "This is a last element on this step");
	$d->AddNode ("last", "unknown", "", "Now this becomes the last element in DLIST");
	$d->AddNode ("somewhere", "first", "", "This element will be between first and uknown elements");
	$d->AddNode ("third", "", "unknown", 12345);
	// Now Dump DLIST!
	$id=$d->fid;
	while (1)
	{
		echo $d->GetData($id)."<BR>";
		if (!($id=$d->GetNext($id))) break;
	}
	echo "<BR>----------------------------------------------<BR><BR>";
	// Now Delete previous from third element (second element)
	$d->DelNode($d->GetPrev("third"));
	// Now Dump DLIST again!
	$id=$d->fid;
	while (1)
        {
                echo $d->GetData($id)."<BR>";
                if (!($id=$d->GetNext($id))) break;
        }
	// That's all folks

*/



?>
