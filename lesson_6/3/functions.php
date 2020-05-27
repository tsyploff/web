<?php
function print_options($table,$value) {
  global $db;
  $query = mysqli_query($db, "select id,name from $table order by name ");
  echo "<option value=''></option>";
  while ($row = mysqli_fetch_assoc($query)) {
    $id = $row['id'];
    $name = $row['name'];
    if ($value == $id)
      echo "<option selected value='$id'>$name</option>";
    else 
      echo "<option value='$id'>$name</option>";
  }
}
function table_form_fields($table) {
  global $db;
  $query = mysqli_query($db,"show columns from $table");
  $flds = [];
  while ($row = mysqli_fetch_assoc($query)) {
    $fld = [];
    $fld_name =  $row['Field'];
    $fld['name'] = $fld_name;
    $fld['label'] = $fld_name;
    if ($row['Field'] == 'id') {
      $fld['type'] = 'hidden';
    } else if ($row['Type'] == 'int(11)' && substr($fld_name,-3) == '_id') {
      $fld['type'] = 'select';
      $fld['options_table']  = substr($fld_name,0,-3);
    } else {
      $fld['type'] = 'text';
    }
    $flds[$fld_name] = $fld;
  }
  return $flds;
}