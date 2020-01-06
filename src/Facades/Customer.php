<?php
namespace QuickBooksOnline\API\Facades;

class Customer{

    public static function create(array $data, $throwException = TRUE){
        if(!isset($data) || empty($data)) throw new \Exception("Passed array for creating Customer is Empty");
        $CustomerObject = FacadeHelper::reflectArrayToObject("Customer", $data, $throwException );
        return $CustomerObject;
    }

    /**
     * This is an immutable function
     */
    public static function update($objToUpdate, array $data){

        // Modified error handling on null
        if($objToUpdate === null) {
            throw new \Exception('Target Customer object instance expected, instead given null');
        }

        $classOfObj = get_class($objToUpdate);
        if(strcmp($classOfObj, FacadeHelper::simpleAppendClassNameSpace("Customer")) != 0){
            throw new \Exception("Target object class:{" .  $classOfObj . "} is not an instance of Customer.");
        }
        $newCustomerObj = Customer::create($data);
        $clonedOfObj = FacadeHelper::cloneObj($objToUpdate);
        FacadeHelper::mergeObj($clonedOfObj, $newCustomerObj);
        return $clonedOfObj;
    }

}
