<?php

$countries = array('PH', 'MY', 'SG', 'CH', 'SK', 'NK', 'TW', 'US');

//0 = Quezon
$cities = array('Quezon', 'Bankok', 'Singapore', 'Beijing', 'Seoul', 'Pyongyang', 'Taipei');

$person = (object) array('name'=>'Mike','age'=>'20');

$persons = range(1,1000);

$names = 'Mike,Mitch,Shekinah,Roselle,Tiro,Mylen';

$names = explode(',', $names);

foreach($persons AS $person_id=>$val){
    $nperson = new $person;
    
    $nperson->name = $names[rand(0,count($names)-1)];
    $nperson->age = rand(20, 50);
    
    $loc_id = rand(0,count($countries)-1);
    
    $nperson->loc_id = $loc_id;
    $nperson->country = $countries[$loc_id];
    $nperson->city = array_key_exists($loc_id, $cities) ? $cities[$loc_id] : 'No City';
    
    $persons[$person_id] = $nperson;
}

header('Content-type: application/json');
echo json_encode($persons);
        
//rand, range, array_push, array_pop, array_shift, array_unshift, implode, is_array, array_key_exists(array keys), in_array (array values), count

?>