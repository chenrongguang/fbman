<?php
class WheatfieldEnterpriseUpdatecompanyinfoRequest
{
     private $apiParas = array();

     private $role;

     public function getRole()
     {
         return $this->$role;
     }

     public function setRole($role)
     {
         $this->role = $role;
         $this->apiParas["role"] = $role;
     }

     private $taxregcards;

     public function getTaxregcards()
     {
         return $this->$taxregcards;
     }

     public function setTaxregcards($taxregcards)
     {
         $this->taxregcards = $taxregcards;
         $this->apiParas["taxregcards"] = $taxregcards;
     }

     private $busplacectf;

     public function getBusplacectf()
     {
         return $this->$busplacectf;
     }

     public function setBusplacectf($busplacectf)
     {
         $this->busplacectf = $busplacectf;
         $this->apiParas["busplacectf"] = $busplacectf;
     }

     private $usertype;

     public function getUsertype()
     {
         return $this->$usertype;
     }

     public function setUsertype($usertype)
     {
         $this->usertype = $usertype;
         $this->apiParas["usertype"] = $usertype;
     }

     private $companycode;

     public function getCompanycode()
     {
         return $this->$companycode;
     }

     public function setCompanycode($companycode)
     {
         $this->companycode = $companycode;
         $this->apiParas["companycode"] = $companycode;
     }

     private $acuntopnlince;

     public function getAcuntopnlince()
     {
         return $this->$acuntopnlince;
     }

     public function setAcuntopnlince($acuntopnlince)
     {
         $this->acuntopnlince = $acuntopnlince;
         $this->apiParas["acuntopnlince"] = $acuntopnlince;
     }

     private $username;

     public function getUsername()
     {
         return $this->$username;
     }

     public function setUsername($username)
     {
         $this->username = $username;
         $this->apiParas["username"] = $username;
     }

     private $post;

     public function getPost()
     {
         return $this->$post;
     }

     public function setPost($post)
     {
         $this->post = $post;
         $this->apiParas["post"] = $post;
     }

     private $companyname;

     public function getCompanyname()
     {
         return $this->$companyname;
     }

     public function setCompanyname($companyname)
     {
         $this->companyname = $companyname;
         $this->apiParas["companyname"] = $companyname;
     }

     private $shortname;

     public function getShortname()
     {
         return $this->$shortname;
     }

     public function setShortname($shortname)
     {
         $this->shortname = $shortname;
         $this->apiParas["shortname"] = $shortname;
     }

     private $productid;

     public function getProductid()
     {
         return $this->$productid;
     }

     public function setProductid($productid)
     {
         $this->productid = $productid;
         $this->apiParas["productid"] = $productid;
     }

     private $constid;

     public function getConstid()
     {
         return $this->$constid;
     }

     public function setConstid($constid)
     {
         $this->constid = $constid;
         $this->apiParas["constid"] = $constid;
     }

     private $opertype;

     public function getOpertype()
     {
         return $this->$opertype;
     }

     public function setOpertype($opertype)
     {
         $this->opertype = $opertype;
         $this->apiParas["opertype"] = $opertype;
     }

     private $remark;

     public function getRemark()
     {
         return $this->$remark;
     }

     public function setRemark($remark)
     {
         $this->remark = $remark;
         $this->apiParas["remark"] = $remark;
     }

     private $loancard;

     public function getLoancard()
     {
         return $this->$loancard;
     }

     public function setLoancard($loancard)
     {
         $this->loancard = $loancard;
         $this->apiParas["loancard"] = $loancard;
     }

     private $corporatename;

     public function getCorporatename()
     {
         return $this->$corporatename;
     }

     public function setCorporatename($corporatename)
     {
         $this->corporatename = $corporatename;
         $this->apiParas["corporatename"] = $corporatename;
     }

     private $taxregcardf;

     public function getTaxregcardf()
     {
         return $this->$taxregcardf;
     }

     public function setTaxregcardf($taxregcardf)
     {
         $this->taxregcardf = $taxregcardf;
         $this->apiParas["taxregcardf"] = $taxregcardf;
     }

     private $organcertificate;

     public function getOrgancertificate()
     {
         return $this->$organcertificate;
     }

     public function setOrgancertificate($organcertificate)
     {
         $this->organcertificate = $organcertificate;
         $this->apiParas["organcertificate"] = $organcertificate;
     }

     private $mcc;

     public function getMcc()
     {
         return $this->$mcc;
     }

     public function setMcc($mcc)
     {
         $this->mcc = $mcc;
         $this->apiParas["mcc"] = $mcc;
     }

     private $connect;

     public function getConnect()
     {
         return $this->$connect;
     }

     public function setConnect($connect)
     {
         $this->connect = $connect;
         $this->apiParas["connect"] = $connect;
     }

     private $corporateidentity;

     public function getCorporateidentity()
     {
         return $this->$corporateidentity;
     }

     public function setCorporateidentity($corporateidentity)
     {
         $this->corporateidentity = $corporateidentity;
         $this->apiParas["corporateidentity"] = $corporateidentity;
     }

     private $userid;

     public function getUserid()
     {
         return $this->$userid;
     }

     public function setUserid($userid)
     {
         $this->userid = $userid;
         $this->apiParas["userid"] = $userid;
     }

     private $buslince;

     public function getBuslince()
     {
         return $this->$buslince;
     }

     public function setBuslince($buslince)
     {
         $this->buslince = $buslince;
         $this->apiParas["buslince"] = $buslince;
     }

     private $address;

     public function getAddress()
     {
         return $this->$address;
     }

     public function setAddress($address)
     {
         $this->address = $address;
         $this->apiParas["address"] = $address;
     }

     public function getApiParas()
     {
         return $this->apiParas;
     }

     public function getApiMethodName()
     {
         return "ruixue.wheatfield.enterprise.updatecompanyinfo";
     }
     public function check()     {          }}
