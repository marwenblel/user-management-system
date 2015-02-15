</br></br></br>
<h2>Uers List</h2>
<?php
$this->table->set_heading('Name', 'Email');
echo $this->table->generate($users_list);
?>