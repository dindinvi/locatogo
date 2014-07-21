<?php
namespace djepo\CalendrierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

 
class EventEntity  
{
     /**
     * @var string HTML color code for the bg color of the event label.
     *  @ORM\Column(name="bgColor",type="string", nullable=true)
     */
    protected $bgColor;
   
     /**
     * @var \DateTime DateTime object of the event start date/time.
     * @ORM\Column(name="startDatetime",type="date", nullable=false)
     */
       protected $startDatetime;
    
    /**
     * @var \DateTime DateTime object of the event end date/time.
     * @ORM\Column(name="endDatetime",type="string", nullable=false)
     */
        protected $endDatetime;
     
    
     
   public function __construct( \DateTime $startDatetime, \DateTime $endDatetime , $allDay = false)
    {
         
        $this->startDatetime = $startDatetime;
         
        
        if ($endDatetime === null && $this->allDay === false) {
            throw new \InvalidArgumentException("Must specify an event End DateTime if not an all day event.");
        }
        
        $this->endDatetime = $endDatetime;
    }

    /**
     * Convert calendar event details to an array
     * 
     * @return array $event 
     */
    public function toArray()
    {
        $event = array();
        
          if ($this->bgColor !== null) {
            $event['backgroundColor'] = $this->bgColor;
            $event['borderColor'] = $this->bgColor;
        }
       
        if ($this->startDatetime !== null) {
            $start= $this->startDatetime->format("Y-m-d\TH:i:sP");
            $event['start'] =  $start;
        }
        if ($this->endDatetime !== null) {
            $end =  $this->endDatetime->format("Y-m-d\TH:i:sP");
            $event['end'] =  $end ;
        }
        
        
        
        return $event;
    }

   
    
    public function setBgColor($color)
    {
        $this->bgColor = $color;
    }
    
    public function getBgColor()
    {
        return $this->bgColor;
    }
    
    public function setFgColor($color)
    {
        $this->fgColor = $color;
    }
    
    public function getFgColor()
    {
        return $this->fgColor;
    }
    
    public function setCssClass($class)
    {
        $this->cssClass = $class;
    }
    
    public function getCssClass()
    {
        return $this->cssClass;
    }
    
    public function setStartDatetime(\DateTime $start)
    {
        $this->startDatetime = $start;
    }
    
    public function getStartDatetime()
    {
        return $this->startDatetime;
    }
    
    public function setEndDatetime(\DateTime $end)
    {
        $this->endDatetime = $end;
    }
    
    public function getEndDatetime()
    {
        return $this->endDatetime;
    }
    
    public function setAllDay($allDay = false)
    {
        $this->allDay = (boolean) $allDay;
    }
    
    public function getAllDay()
    {
        return $this->allDay;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addField($name, $value)
    {
        $this->otherFields[$name] = $value;
    }

    /**
     * @param string $name
     */
    public function removeField($name)
    {
        if (!array_key_exists($name, $this->otherFields)) {
            return;
        }

        unset($this->otherFields[$name]);
    }
    
   
}