<?php

namespace Eshop\ShopBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Eshop\ShopBundle\Repository\ProductRepository")
 * @UniqueEntity("slug"),
 *     errorPath="slug",
 *     message="This slug is already in use."
 * @ORM\HasLifecycleCallbacks()
 */
class Product
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false, unique=true)
     */

    private $slug;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keys", type="text", nullable=true)
     */
    private $metaKeys;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="text", nullable=true)
     */
    private $metaDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     * @Assert\Range(
     *      min = 0,
     *      minMessage = "Must be at least {{ limit }}",
     * )
     */
    private $quantity;

    /**
     * @var integer
     *
     * @ORM\Column(name="measure_quantity", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      minMessage = "Must be at least {{ limit }}",
     * )
     */
    private $measureQuantity;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     **/
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Manufacturer", inversedBy="products")
     * @ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id")
     **/
    private $manufacturer;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="product", cascade={"remove"})
     **/
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="OrderProduct", mappedBy="product")
     **/
    private $productOrders;

    /**
     * @ORM\ManyToOne(targetEntity="Measure", inversedBy="products")
     * @ORM\JoinColumn(name="measure_id", referencedColumnName="id")
     **/
    private $measure;

    public function __construct() {
        $this->productOrders = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->quantity = 1;
    }

    public function __toString() {
        return $this->getName();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set category
     *
     * @param \Eshop\ShopBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\Eshop\ShopBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Eshop\ShopBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set manufacturer
     *
     * @param \Eshop\ShopBundle\Entity\Manufacturer $manufacturer
     * @return Product
     */
    public function setManufacturer(\Eshop\ShopBundle\Entity\Manufacturer $manufacturer = null)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return \Eshop\ShopBundle\Entity\Manufacturer 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Add images
     *
     * @param \Eshop\ShopBundle\Entity\Image $images
     * @return Product
     */
    public function addImage(\Eshop\ShopBundle\Entity\Image $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \Eshop\ShopBundle\Entity\Image $images
     */
    public function removeImage(\Eshop\ShopBundle\Entity\Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add productOrders
     *
     * @param \Eshop\ShopBundle\Entity\OrderProduct $productOrders
     * @return Product
     */
    public function addProductOrder(\Eshop\ShopBundle\Entity\OrderProduct $productOrders)
    {
        $this->productOrders[] = $productOrders;

        return $this;
    }

    /**
     * Remove productOrders
     *
     * @param \Eshop\ShopBundle\Entity\OrderProduct $productOrders
     */
    public function removeProductOrder(\Eshop\ShopBundle\Entity\OrderProduct $productOrders)
    {
        $this->productOrders->removeElement($productOrders);
    }

    /**
     * Get productOrders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductOrders()
    {
        return $this->productOrders;
    }

    /**
     * Set metaKeys
     *
     * @param string $metaKeys
     * @return Product
     */
    public function setMetaKeys($metaKeys)
    {
        $this->metaKeys = $metaKeys;

        return $this;
    }

    /**
     * Get metaKeys
     *
     * @return string 
     */
    public function getMetaKeys()
    {
        return $this->metaKeys;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return Product
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string 
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set measureQuantity
     *
     * @param integer $measureQuantity
     * @return Product
     */
    public function setMeasureQuantity($measureQuantity)
    {
        $this->measureQuantity = $measureQuantity;

        return $this;
    }

    /**
     * Get measureQuantity
     *
     * @return integer 
     */
    public function getMeasureQuantity()
    {
        return $this->measureQuantity;
    }

    /**
     * Set measure
     *
     * @param \Eshop\ShopBundle\Entity\Measure $measure
     * @return Product
     */
    public function setMeasure(\Eshop\ShopBundle\Entity\Measure $measure = null)
    {
        $this->measure = $measure;

        return $this;
    }

    /**
     * Get measure
     *
     * @return \Eshop\ShopBundle\Entity\Measure 
     */
    public function getMeasure()
    {
        return $this->measure;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Product
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
