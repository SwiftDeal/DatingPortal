<?php

/**
 * The User Model
 *
 * @author Cloudstuffs Team
 */
class UserProfile extends Shared\Model {

    /**
     * @column
     * @readwrite
     * @type text
     * @label User Id
     */
    protected $_user_id;

    /**
     * @column
     * @readwrite
     * @type text
     * 
     * @label Self Summary
     */
    protected $_self_summary;

    /**
     * @column
     * @readwrite
     * @type text
     * 
     * @label Favourites
     */
    protected $_favourites;

    /**
     * @column
     * @readwrite
     * @type text
     * 
     * @label Not Comporomise
     */
    protected $_ncompromise;

	/**
     * @column
     * @readwrite
     * @type text
     * 
     * 
     * @label Members In Family
     */
    protected $_family_members;
/**
     * @column
     * @readwrite
     * @type text
     * 
     * 
     * @label Family Type
     */
    protected $_ftype;
/**
     * @column
     * @readwrite
     * @type text
     * 
     * 
     * @label Status
     */
    protected $_status;
/**
     * @column
     * @readwrite
     * @type text
     * 
     * 
     * @label Smoking
     */
    protected $_smoke;

    /**
     * @column
     * @readwrite
     * @type text
     * 
     * 
     * @label Drinking
     */
    protected $_drink;
    /**
     * @column
     * @readwrite
     * @type text
     * 
     * 
     * @label Language Known
     */
    protected $_language;
    /**
     * @column
     * @readwrite
     * @type text
     * 
     * 
     * @label Height
     */
    protected $_height;
/**
     * @column
     * @readwrite
     * @type text
     * 
     * 
     * @label Weight
     */
    protected $_weight;

    /**
     * @column
     * @readwrite
     * @type text
     * 
     * 
     * @label rashi
     */
    protected $_rashi;
    /**
     * @column
     * @readwrite
     * @type text
     * 
     * 
     * @label Profession
     */
    protected $_profession;
    /**
     * @column
     * @readwrite
     * @type text
     * 
     * 
     * @label Highest Qualification
     */
    protected $_qualification;
    /**
     * @column
     * @readwrite
     * @type text
     * 
     * 
     * @label Job Status
     */
    protected $_job_status;

}
