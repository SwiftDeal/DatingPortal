<?php

/**
 * The User Model
 *
 * @author Cloudstuffs Team
 */
class User extends Shared\Model {

    /**
     * @column
     * @readwrite
     * @primary
     * @type autonumber
     */
    protected $_id;

    /**
     * @column
     * @readwrite
     * @type text
     * @length 100
     * 
     * @validate required, alpha, min(3), max(32)
     * @label first name
     */
    protected $_name;

    /**
     * @column
     * @readwrite
     * @type text
     * @length 10
     * 
     * @validate required, alpha, min(3), max(32)
     * @label Gender
     */
    protected $_gender;

    /**
     * @column
     * @readwrite
     * @type text
     * @length 100
     * @index
     * 
     * @validate required, max(100)
     * @label email address
     */
    protected $_email;

	/**
     * @column
     * @readwrite
     * @type text
     * @length 100
     * @index
     * 
     * @validate required, max(100)
     * @label Mobile Number
     */
    protected $_mobile;
/**
     * @column
     * @readwrite
     * @type text
     * @length 3
     * @index
     * 
     * @validate required, max(5)
     * @label Age
     */
    protected $_age;
/**
     * @column
     * @readwrite
     * @type text
     * @length 100
     * @index
     * 
     * @label Religion
     */
    protected $_religion;
/**
     * @column
     * @readwrite
     * @type text
     * @length 100
     * @index
     * 
     * @label Caste
     */
    protected $_caste;

    /**
     * @column
     * @readwrite
     * @type text
     * @length 100
     * @index
     * 
     * @validate required, alpha, min(8), max(32)
     * @label password
     */
    protected $_password;
    
    /**
    * @column
    * @readwrite
    * @type boolean
    */
    protected $_admin = false;

}
