<?php

namespace Rougin\Dexterine;

use Rougin\Gable\Pagee;

/**
 * @package Dexterine
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Depot
{
    /**
     * @var \Rougin\Dexterine\Method[]
     */
    protected $fns = array();

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \Rougin\Fortem\Script|null
     */
    protected $script = null;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return \Rougin\Dexterine\Close
     */
    public function withClose()
    {
        return new Close($this->name);
    }

    /**
     * @return \Rougin\Dexterine\Edit
     */
    public function withEdit()
    {
        return new Edit($this->name);
    }

    /**
     * @param integer $page
     *
     * @return \Rougin\Dexterine\Init
     */
    public function withInit($page = 1)
    {
        return new Init($page, $this->name);
    }

    /**
     * @param \Rougin\Gable\Pagee $pagee
     *
     * @return \Rougin\Dexterine\Load
     */
    public function withLoad(Pagee $pagee)
    {
        return new Load($pagee, $this->name);
    }

    /**
     * @param string $name
     *
     * @return \Rougin\Dexterine\Modal
     */
    public function withModal($name)
    {
        $modal = new Modal($this->name);

        /** @var \Rougin\Dexterine\Modal */
        return $modal->setName($name);
    }

    /**
     * @return \Rougin\Dexterine\Remove
     */
    public function withRemove()
    {
        return new Remove($this->name);
    }

    /**
     * @return \Rougin\Dexterine\Store
     */
    public function withStore()
    {
        return new Store($this->name);
    }

    /**
     * @return \Rougin\Dexterine\Trash
     */
    public function withTrash()
    {
        return new Trash($this->name);
    }

    /**
     * @return \Rougin\Dexterine\Update
     */
    public function withUpdate()
    {
        return new Update($this->name);
    }
}
