<?php

class Lp_RPC_Model_DeviceFilter
{

    const CRITERIA_OPERATOR_EQ         = 'EQ';
    const CRITERIA_OPERATOR_NEQ        = 'NEQ';
    const CRITERIA_OPERATOR_GT         = 'GT';
    const CRITERIA_OPERATOR_GTEQ       = 'GTEQ';
    const CRITERIA_OPERATOR_LT         = 'LT';
    const CRITERIA_OPERATOR_LTEQ       = 'LTEQ';
    const CRITERIA_OPERATOR_CONTAIN    = 'CONTAIN';
    const CRITERIA_OPERATOR_NOTCONTAIN = 'NOTCONTAIN';

    /**
     * @var array
     */
    public static $CRITERIA_OPERATORS = array(
        self::CRITERIA_OPERATOR_EQ => '=',
        self::CRITERIA_OPERATOR_NEQ => '!=',
        self::CRITERIA_OPERATOR_GT => '>',
        self::CRITERIA_OPERATOR_GTEQ => '>=',
        self::CRITERIA_OPERATOR_LT => '<',
        self::CRITERIA_OPERATOR_LTEQ => '<=',
    );

    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $criteria;

    /**
     * @var int|null
     */
    protected $calcDevicesTotal;

    /**
     * @param int    $id
     * @param string $name
     * @param string $criteria
     */
    public function __construct ($id, $name, $criteria)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->criteria = $criteria;
    }

    /**
     * @return int
     */
    public function getId ()
    {
        return (int) $this->id;
    }

    /**
     * @param int $id
     */
    public function setId ($id)
    {
        $this->id = (int) $id;
    }

    /**
     * @return string
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName ($name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getCriteria ()
    {
        return json_decode($this->criteria, true);
    }

    /**
     * @param array $criteria
     */
    public function setCriteria ($criteria)
    {
        $this->criteria = json_encode($criteria);
    }

    /**
     * @param string $uid
     *
     * @return array
     */
    public function getCriteriaItemByUid ($uid)
    {
        foreach ($this->getCriteria() as $item) {
            if ($item['uid'] === $uid) {
                return $item;
            }
        }
        return array();
    }

    /**
     * @param string $uid
     * @param array  $data
     */
    public function setCriteriaItemByUid ($uid, $data)
    {
        $data['uid'] = $uid;
        $criteria    = $this->getCriteria();
        foreach ($criteria as $index => $item) {
            if ($item['uid'] === $uid) {
                $criteria[$index] = $data;
            }
        }
        $this->setCriteria($criteria);
    }

    /**
     * @param string $uid
     */
    public function deleteCriteriaItemByUid ($uid)
    {
        $criteria = $this->getCriteria();
        foreach ($criteria as $index => $item) {
            if ($item['uid'] === $uid) {
                unset($criteria[$index]);
                break;
            }
        }
        $this->setCriteria($criteria);
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public function insertCriteriaItemAndGetUid ($data)
    {
        $data['uid'] = uniqid();
        $criteria    = $this->getCriteria();
        $criteria[]  = $data;
        $this->setCriteria($criteria);
        return $data['uid'];
    }

    /**
     * @return int|null
     */
    public function getCalcDevicesTotal ()
    {
        return $this->calcDevicesTotal;
    }

    /**
     * @param int|null $value
     */
    public function setCalcDevicesTotal ($value = null)
    {
        $this->calcDevicesTotal = $value;
    }

}
