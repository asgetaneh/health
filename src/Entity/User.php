<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json",nullable=true)
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string",nullable=true)
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\UserGroup", inversedBy="users")
     */
    private $userGroup;
    
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserInfo", mappedBy="user", cascade={"persist", "remove"})
     */
    private $userInfo;

  

    /**
     * @ORM\OneToMany(targetEntity=UserGroup::class, mappedBy="registerBy")
     */
    private $userGroups;

    /**
     * @ORM\OneToMany(targetEntity=Perspective::class, mappedBy="createdBy")
     */
    private $perspectives;

    /**
     * @ORM\OneToMany(targetEntity=Goal::class, mappedBy="createdBy")
     */
    private $goals;

    /**
     * @ORM\OneToMany(targetEntity=Objective::class, mappedBy="CreatedBy")
     */
    private $objectives;

    /**
     * @ORM\OneToMany(targetEntity=Strategy::class, mappedBy="createdBy")
     */
    private $strategies;

    /**
     * @ORM\OneToMany(targetEntity=KeyPerformanceIndicator::class, mappedBy="createdBy")
     */
    private $keyPerformanceIndicators;

    /**
     * @ORM\OneToMany(targetEntity=InitiativeBehaviourCatagory::class, mappedBy="createdBy")
     */
    private $initiativeBehaviourCatagories;

    /**
     * @ORM\OneToMany(targetEntity=InitiativeBehaviour::class, mappedBy="createdBy")
     */
    private $initiativeBehaviours;

    /**
     * @ORM\OneToMany(targetEntity=InitiativeAttribute::class, mappedBy="createdBy")
     */
    private $initiativeAttributes;

    /**
     * @ORM\OneToMany(targetEntity=Initiative::class, mappedBy="createdBy")
     */
    private $initiatives;

    /**
     * @ORM\OneToMany(targetEntity=PrincipalOffice::class, mappedBy="createdBy")
     */
    private $principalOffices;

    /**
     * @ORM\OneToMany(targetEntity=OperationalOffice::class, mappedBy="createdBy")
     */
    private $operationalOffices;

    /**
     * @ORM\OneToMany(targetEntity=PrincipalManager::class, mappedBy="principal")
     */
    private $principalManagers;

    /**
     * @ORM\OneToMany(targetEntity=OperationalManager::class, mappedBy="manager")
     */
    private $operationalManagers;

    /**
     * @ORM\OneToMany(targetEntity=Performer::class, mappedBy="performer")
     */
    private $performers;

    /**
     * @ORM\OneToMany(targetEntity=PlanningYear::class, mappedBy="createdBy")
     */
    private $planningYears;

    /**
     * @ORM\OneToMany(targetEntity=PlanningPhase::class, mappedBy="createdBy")
     */
    private $planningPhases;

    /**
     * @ORM\OneToMany(targetEntity=Plan::class, mappedBy="createdBy")
     */
    private $plans;

    /**
     * @ORM\OneToMany(targetEntity=TaskAssign::class, mappedBy="assignedBy")
     */
    private $taskAssigns;

    /**
     * @ORM\OneToMany(targetEntity=Measure::class, mappedBy="createdBy")
     */
    private $measures;

    /**

     * @ORM\OneToMany(targetEntity=PlanningQuarter::class, mappedBy="createdBy")
     */
    private $planningQuarters;
     /** 
      * @ORM\OneToMany(targetEntity=TaskAssign::class, mappedBy="assignedTo")
     */
    private $taskAssignsTo;

    /**
     * @ORM\OneToMany(targetEntity=TaskUser::class, mappedBy="assignedTo")
     */
    private $taskUsers;

    /**
     * @ORM\OneToMany(targetEntity=OperationalTask::class, mappedBy="createdBy")
     */
    private $operationalTasks;

    /**
     * @ORM\OneToMany(targetEntity=PerformerTask::class, mappedBy="createdBy")
     */
    private $performerTasks;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $locale;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Delegation::class, mappedBy="delegatedBy")
     */
    private $delegations;

    /**
     * @ORM\OneToMany(targetEntity=PerformerTask::class, mappedBy="deligateBy")
     */
    private $performerTaskDelegate;

    /**
     * @ORM\OneToMany(targetEntity=TaskAssign::class, mappedBy="delegate")
     */
    private $taskAssignsDelegate;

    /**
     * @ORM\OneToMany(targetEntity=Evaluation::class, mappedBy="evaluateUser")
     */
    private $evaluations;

    /**
     * @ORM\ManyToOne(targetEntity=StaffType::class, inversedBy="users")
     */
    private $staffType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alternativeEmail;
    public function __construct()
    {
      
        $this->userPermissions = new ArrayCollection();
        $this->userGroup = new ArrayCollection();
        $this->perspectives = new ArrayCollection();
        $this->goals = new ArrayCollection();
        $this->objectives = new ArrayCollection();
        $this->strategies = new ArrayCollection();
        $this->keyPerformanceIndicators = new ArrayCollection();
        $this->initiativeBehaviourCatagories = new ArrayCollection();
        $this->initiativeBehaviours = new ArrayCollection();
        $this->initiativeAttributes = new ArrayCollection();
        $this->initiatives = new ArrayCollection();
        $this->principalOffices = new ArrayCollection();
        $this->operationalOffices = new ArrayCollection();
        $this->principalManagers = new ArrayCollection();
        $this->operationalManagers = new ArrayCollection();
        $this->performers = new ArrayCollection();
        $this->planningYears = new ArrayCollection();
        $this->planningPhases = new ArrayCollection();
        $this->plans = new ArrayCollection();
        $this->taskAssigns = new ArrayCollection();
        $this->measures = new ArrayCollection();
        $this->userGroups = new ArrayCollection();

        $this->planningQuarters = new ArrayCollection();

        $this->taskAssignsTo = new ArrayCollection();
        $this->taskUsers = new ArrayCollection();
        $this->operationalTasks = new ArrayCollection();
        $this->performerTasks = new ArrayCollection();
        $this->delegations = new ArrayCollection();
        $this->performerTaskDelegate = new ArrayCollection();
        $this->taskAssignsDelegate = new ArrayCollection();
        $this->evaluations = new ArrayCollection();

    }
    public function __toString()
    {
        return $this->username;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    public function getUserInfo(): ?UserInfo
    {
        return $this->userInfo;
    }

    public function setUserInfo(UserInfo $userInfo): self
    {
        $this->userInfo = $userInfo;

        // set the owning side of the relation if necessary
        if ($userInfo->getUser() !== $this) {
            $userInfo->setUser($this);
        }

        return $this;
    }

    // /**
    //  * A visual identifier that represents this user.
    //  *
    //  * @see UserInterface
    //  */
    // public function getUsername(): string
    // {
    //     return (string) $this->username;
    // }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

   
    /**
     * @return Collection|UserGroup[]
     */
    public function getUserGroup(): Collection
    {
        return $this->userGroup;
    }

    public function addUserGroup(UserGroup $userGroup): self
    {
        if (!$this->userGroup->contains($userGroup)) {
            $this->userGroup[] = $userGroup;
        }

        return $this;
    }

    public function removeUserGroup(UserGroup $userGroup): self
    {
        if ($this->userGroup->contains($userGroup)) {
            $this->userGroup->removeElement($userGroup);
        }

        return $this;
    }
    // /**
    //  * @return Collection|UserPermission[]
    //  */
    // public function getUserPermissions(): Collection
    // {
    //     return $this->userPermissions;
    // }

    // public function addUserPermission(UserPermission $userPermission): self
    // {
    //     if (!$this->userPermissions->contains($userPermission)) {
    //         $this->userPermissions[] = $userPermission;
    //         $userPermission->setUser($this);
    //     }

    //     return $this;
    // }

    // public function removeUserPermission(UserPermission $userPermission): self
    // {
    //     if ($this->userPermissions->removeElement($userPermission)) {
    //         // set the owning side to null (unless already changed)
    //         if ($userPermission->getUser() === $this) {
    //             $userPermission->setUser(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection|Perspective[]
     */
    public function getPerspectives(): Collection
    {
        return $this->perspectives;
    }

    public function addPerspective(Perspective $perspective): self
    {
        if (!$this->perspectives->contains($perspective)) {
            $this->perspectives[] = $perspective;
            $perspective->setCreatedBy($this);
        }

        return $this;
    }

    public function removePerspective(Perspective $perspective): self
    {
        if ($this->perspectives->removeElement($perspective)) {
            // set the owning side to null (unless already changed)
            if ($perspective->getCreatedBy() === $this) {
                $perspective->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Goal[]
     */
    public function getGoals(): Collection
    {
        return $this->goals;
    }

    public function addGoal(Goal $goal): self
    {
        if (!$this->goals->contains($goal)) {
            $this->goals[] = $goal;
            $goal->setCreatedBy($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): self
    {
        if ($this->goals->removeElement($goal)) {
            // set the owning side to null (unless already changed)
            if ($goal->getCreatedBy() === $this) {
                $goal->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Objective[]
     */
    public function getObjectives(): Collection
    {
        return $this->objectives;
    }

    public function addObjective(Objective $objective): self
    {
        if (!$this->objectives->contains($objective)) {
            $this->objectives[] = $objective;
            $objective->setCreatedBy($this);
        }

        return $this;
    }

    public function removeObjective(Objective $objective): self
    {
        if ($this->objectives->removeElement($objective)) {
            // set the owning side to null (unless already changed)
            if ($objective->getCreatedBy() === $this) {
                $objective->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Strategy[]
     */
    public function getStrategies(): Collection
    {
        return $this->strategies;
    }

    public function addStrategy(Strategy $strategy): self
    {
        if (!$this->strategies->contains($strategy)) {
            $this->strategies[] = $strategy;
            $strategy->setCreatedBy($this);
        }

        return $this;
    }

    public function removeStrategy(Strategy $strategy): self
    {
        if ($this->strategies->removeElement($strategy)) {
            // set the owning side to null (unless already changed)
            if ($strategy->getCreatedBy() === $this) {
                $strategy->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|KeyPerformanceIndicator[]
     */
    public function getKeyPerformanceIndicators(): Collection
    {
        return $this->keyPerformanceIndicators;
    }

    public function addKeyPerformanceIndicator(KeyPerformanceIndicator $keyPerformanceIndicator): self
    {
        if (!$this->keyPerformanceIndicators->contains($keyPerformanceIndicator)) {
            $this->keyPerformanceIndicators[] = $keyPerformanceIndicator;
            $keyPerformanceIndicator->setCreatedBy($this);
        }

        return $this;
    }

    public function removeKeyPerformanceIndicator(KeyPerformanceIndicator $keyPerformanceIndicator): self
    {
        if ($this->keyPerformanceIndicators->removeElement($keyPerformanceIndicator)) {
            // set the owning side to null (unless already changed)
            if ($keyPerformanceIndicator->getCreatedBy() === $this) {
                $keyPerformanceIndicator->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InitiativeBehaviourCatagory[]
     */
    public function getInitiativeBehaviourCatagories(): Collection
    {
        return $this->initiativeBehaviourCatagories;
    }

    public function addInitiativeBehaviourCatagory(InitiativeBehaviourCatagory $initiativeBehaviourCatagory): self
    {
        if (!$this->initiativeBehaviourCatagories->contains($initiativeBehaviourCatagory)) {
            $this->initiativeBehaviourCatagories[] = $initiativeBehaviourCatagory;
            $initiativeBehaviourCatagory->setCreatedBy($this);
        }

        return $this;
    }

    public function removeInitiativeBehaviourCatagory(InitiativeBehaviourCatagory $initiativeBehaviourCatagory): self
    {
        if ($this->initiativeBehaviourCatagories->removeElement($initiativeBehaviourCatagory)) {
            // set the owning side to null (unless already changed)
            if ($initiativeBehaviourCatagory->getCreatedBy() === $this) {
                $initiativeBehaviourCatagory->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InitiativeBehaviour[]
     */
    public function getInitiativeBehaviours(): Collection
    {
        return $this->initiativeBehaviours;
    }

    public function addInitiativeBehaviour(InitiativeBehaviour $initiativeBehaviour): self
    {
        if (!$this->initiativeBehaviours->contains($initiativeBehaviour)) {
            $this->initiativeBehaviours[] = $initiativeBehaviour;
            $initiativeBehaviour->setCreatedBy($this);
        }

        return $this;
    }

    public function removeInitiativeBehaviour(InitiativeBehaviour $initiativeBehaviour): self
    {
        if ($this->initiativeBehaviours->removeElement($initiativeBehaviour)) {
            // set the owning side to null (unless already changed)
            if ($initiativeBehaviour->getCreatedBy() === $this) {
                $initiativeBehaviour->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InitiativeAttribute[]
     */
    public function getInitiativeAttributes(): Collection
    {
        return $this->initiativeAttributes;
    }

    public function addInitiativeAttribute(InitiativeAttribute $initiativeAttribute): self
    {
        if (!$this->initiativeAttributes->contains($initiativeAttribute)) {
            $this->initiativeAttributes[] = $initiativeAttribute;
            $initiativeAttribute->setCreatedBy($this);
        }

        return $this;
    }

    public function removeInitiativeAttribute(InitiativeAttribute $initiativeAttribute): self
    {
        if ($this->initiativeAttributes->removeElement($initiativeAttribute)) {
            // set the owning side to null (unless already changed)
            if ($initiativeAttribute->getCreatedBy() === $this) {
                $initiativeAttribute->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Initiative[]
     */
    public function getInitiatives(): Collection
    {
        return $this->initiatives;
    }

    public function addInitiative(Initiative $initiative): self
    {
        if (!$this->initiatives->contains($initiative)) {
            $this->initiatives[] = $initiative;
            $initiative->setCreatedBy($this);
        }

        return $this;
    }

    public function removeInitiative(Initiative $initiative): self
    {
        if ($this->initiatives->removeElement($initiative)) {
            // set the owning side to null (unless already changed)
            if ($initiative->getCreatedBy() === $this) {
                $initiative->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PrincipalOffice[]
     */
    public function getPrincipalOffices(): Collection
    {
        return $this->principalOffices;
    }

    public function addPrincipalOffice(PrincipalOffice $principalOffice): self
    {
        if (!$this->principalOffices->contains($principalOffice)) {
            $this->principalOffices[] = $principalOffice;
            $principalOffice->setCreatedBy($this);
        }

        return $this;
    }

    public function removePrincipalOffice(PrincipalOffice $principalOffice): self
    {
        if ($this->principalOffices->removeElement($principalOffice)) {
            // set the owning side to null (unless already changed)
            if ($principalOffice->getCreatedBy() === $this) {
                $principalOffice->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OperationalOffice[]
     */
    public function getOperationalOffices(): Collection
    {
        return $this->operationalOffices;
    }

    public function addOperationalOffice(OperationalOffice $operationalOffice): self
    {
        if (!$this->operationalOffices->contains($operationalOffice)) {
            $this->operationalOffices[] = $operationalOffice;
            $operationalOffice->setCreatedBy($this);
        }

        return $this;
    }

    public function removeOperationalOffice(OperationalOffice $operationalOffice): self
    {
        if ($this->operationalOffices->removeElement($operationalOffice)) {
            // set the owning side to null (unless already changed)
            if ($operationalOffice->getCreatedBy() === $this) {
                $operationalOffice->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PrincipalManager[]
     */
    public function getPrincipalManagers(): Collection
    {
        return $this->principalManagers;
    }

    public function addPrincipalManager(PrincipalManager $principalManager): self
    {
        if (!$this->principalManagers->contains($principalManager)) {
            $this->principalManagers[] = $principalManager;
            $principalManager->setPrincipal($this);
        }

        return $this;
    }

    public function removePrincipalManager(PrincipalManager $principalManager): self
    {
        if ($this->principalManagers->removeElement($principalManager)) {
            // set the owning side to null (unless already changed)
            if ($principalManager->getPrincipal() === $this) {
                $principalManager->setPrincipal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OperationalManager[]
     */
    public function getOperationalManagers(): Collection
    {
        return $this->operationalManagers;
    }

    public function addOperationalManager(OperationalManager $operationalManager): self
    {
        if (!$this->operationalManagers->contains($operationalManager)) {
            $this->operationalManagers[] = $operationalManager;
            $operationalManager->setManager($this);
        }

        return $this;
    }

    public function removeOperationalManager(OperationalManager $operationalManager): self
    {
        if ($this->operationalManagers->removeElement($operationalManager)) {
            // set the owning side to null (unless already changed)
            if ($operationalManager->getManager() === $this) {
                $operationalManager->setManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Performer[]
     */
    public function getPerformers(): Collection
    {
        return $this->performers;
    }

    public function addPerformer(Performer $performer): self
    {
        if (!$this->performers->contains($performer)) {
            $this->performers[] = $performer;
            $performer->setPerformer($this);
        }

        return $this;
    }

    public function removePerformer(Performer $performer): self
    {
        if ($this->performers->removeElement($performer)) {
            // set the owning side to null (unless already changed)
            if ($performer->getPerformer() === $this) {
                $performer->setPerformer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PlanningYear[]
     */
    public function getPlanningYears(): Collection
    {
        return $this->planningYears;
    }

    public function addPlanningYear(PlanningYear $planningYear): self
    {
        if (!$this->planningYears->contains($planningYear)) {
            $this->planningYears[] = $planningYear;
            $planningYear->setCreatedBy($this);
        }

        return $this;
    }

    public function removePlanningYear(PlanningYear $planningYear): self
    {
        if ($this->planningYears->removeElement($planningYear)) {
            // set the owning side to null (unless already changed)
            if ($planningYear->getCreatedBy() === $this) {
                $planningYear->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PlanningPhase[]
     */
    public function getPlanningPhases(): Collection
    {
        return $this->planningPhases;
    }

    public function addPlanningPhase(PlanningPhase $planningPhase): self
    {
        if (!$this->planningPhases->contains($planningPhase)) {
            $this->planningPhases[] = $planningPhase;
            $planningPhase->setCreatedBy($this);
        }

        return $this;
    }

    public function removePlanningPhase(PlanningPhase $planningPhase): self
    {
        if ($this->planningPhases->removeElement($planningPhase)) {
            // set the owning side to null (unless already changed)
            if ($planningPhase->getCreatedBy() === $this) {
                $planningPhase->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Plan[]
     */
    public function getPlans(): Collection
    {
        return $this->plans;
    }

    public function addPlan(Plan $plan): self
    {
        if (!$this->plans->contains($plan)) {
            $this->plans[] = $plan;
            $plan->setCreatedBy($this);
        }

        return $this;
    }

    public function removePlan(Plan $plan): self
    {
        if ($this->plans->removeElement($plan)) {
            // set the owning side to null (unless already changed)
            if ($plan->getCreatedBy() === $this) {
                $plan->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TaskAssign[]
     */
    public function getTaskAssigns(): Collection
    {
        return $this->taskAssigns;
    }

    public function addTaskAssign(TaskAssign $taskAssign): self
    {
        if (!$this->taskAssigns->contains($taskAssign)) {
            $this->taskAssigns[] = $taskAssign;
            $taskAssign->setAssignedBy($this);
        }

        return $this;
    }

    public function removeTaskAssign(TaskAssign $taskAssign): self
    {
        if ($this->taskAssigns->removeElement($taskAssign)) {
            // set the owning side to null (unless already changed)
            if ($taskAssign->getAssignedBy() === $this) {
                $taskAssign->setAssignedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Measure[]
     */
    public function getMeasures(): Collection
    {
        return $this->measures;
    }

    public function addMeasure(Measure $measure): self
    {
        if (!$this->measures->contains($measure)) {
            $this->measures[] = $measure;
            $measure->setCreatedBy($this);
        }

        return $this;
    }

    public function removeMeasure(Measure $measure): self
    {
        if ($this->measures->removeElement($measure)) {
            // set the owning side to null (unless already changed)
            if ($measure->getCreatedBy() === $this) {
                $measure->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserGroup[]
     */
    public function getUserGroups(): Collection
    {
        return $this->userGroups;
    }

    /**

     * @return Collection|PlanningQuarter[]
     */
    public function getPlanningQuarters(): Collection
    {
        return $this->planningQuarters;
    }

    public function addPlanningQuarter(PlanningQuarter $planningQuarter): self
    {
        if (!$this->planningQuarters->contains($planningQuarter)) {
            $this->planningQuarters[] = $planningQuarter;
            $planningQuarter->setCreatedBy($this);
        }

        return $this;
        }


    /**
     *  @return Collection|TaskAssign[]
     */
    public function getTaskAssignsTo(): Collection
    {
        return $this->taskAssignsTo;
    }

    public function addTaskAssignsTo(TaskAssign $taskAssignsTo): self
    {
        if (!$this->taskAssignsTo->contains($taskAssignsTo)) {
            $this->taskAssignsTo[] = $taskAssignsTo;
            $taskAssignsTo->setAssignedTo($this);

        }

        return $this;
    }


    public function removePlanningQuarter(PlanningQuarter $planningQuarter): self
    {
        if ($this->planningQuarters->removeElement($planningQuarter)) {
            // set the owning side to null (unless already changed)
            if ($planningQuarter->getCreatedBy() === $this) {
                $planningQuarter->setCreatedBy(null);
            }
        }
          return $this;
        }

    public function removeTaskAssignsTo(TaskAssign $taskAssignsTo): self
    {
        if ($this->taskAssignsTo->removeElement($taskAssignsTo)) {
            // set the owning side to null (unless already changed)
            if ($taskAssignsTo->getAssignedTo() === $this) {
                $taskAssignsTo->setAssignedTo(null);

            }
        }

        return $this;
    }

    /**
     * @return Collection|TaskUser[]
     */
    public function getTaskUsers(): Collection
    {
        return $this->taskUsers;
    }

    public function addTaskUser(TaskUser $taskUser): self
    {
        if (!$this->taskUsers->contains($taskUser)) {
            $this->taskUsers[] = $taskUser;
            $taskUser->setAssignedTo($this);
        }

        return $this;
    }

    public function removeTaskUser(TaskUser $taskUser): self
    {
        if ($this->taskUsers->removeElement($taskUser)) {
            // set the owning side to null (unless already changed)
            if ($taskUser->getAssignedTo() === $this) {
                $taskUser->setAssignedTo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OperationalTask[]
     */
    public function getOperationalTasks(): Collection
    {
        return $this->operationalTasks;
    }

    public function addOperationalTask(OperationalTask $operationalTask): self
    {
        if (!$this->operationalTasks->contains($operationalTask)) {
            $this->operationalTasks[] = $operationalTask;
            $operationalTask->setCreatedBy($this);
        }

        return $this;
    }

    public function removeOperationalTask(OperationalTask $operationalTask): self
    {
        if ($this->operationalTasks->removeElement($operationalTask)) {
            // set the owning side to null (unless already changed)
            if ($operationalTask->getCreatedBy() === $this) {
                $operationalTask->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PerformerTask[]
     */
    public function getPerformerTasks(): Collection
    {
        return $this->performerTasks;
    }

    public function addPerformerTask(PerformerTask $performerTask): self
    {
        if (!$this->performerTasks->contains($performerTask)) {
            $this->performerTasks[] = $performerTask;
            $performerTask->setCreatedBy($this);
        }

        return $this;
    }

    public function removePerformerTask(PerformerTask $performerTask): self
    {
        if ($this->performerTasks->removeElement($performerTask)) {
            // set the owning side to null (unless already changed)
            if ($performerTask->getCreatedBy() === $this) {
                $performerTask->setCreatedBy(null);
            }
        }

        return $this;
    }


    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(?string $locale): self
    {
        $this->locale = $locale;

   }
    public function getUserType(): ?int
    {
        return $this->userType;
    }

    public function setUserType(?int $userType): self
    {
        $this->userType = $userType;

        return $this;
    }

    public function getEmailLocalPart(): ?string
    {
        return $this->emailLocalPart;
    }

    public function setEmailLocalPart(?string $emailLocalPart): self
    {
        $this->emailLocalPart = $emailLocalPart;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Delegation[]
     */
    public function getDelegations(): Collection
    {
        return $this->delegations;
    }

    public function addDelegation(Delegation $delegation): self
    {
        if (!$this->delegations->contains($delegation)) {
            $this->delegations[] = $delegation;
            $delegation->setDelegatedBy($this);
        }

        return $this;
    }

    public function removeDelegation(Delegation $delegation): self
    {
        if ($this->delegations->removeElement($delegation)) {
            // set the owning side to null (unless already changed)
            if ($delegation->getDelegatedBy() === $this) {
                $delegation->setDelegatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PerformerTask[]
     */
    public function getPerformerTaskDelegate(): Collection
    {
        return $this->performerTaskDelegate;
    }

    public function addPerformerTaskDelegate(PerformerTask $performerTaskDelegate): self
    {
        if (!$this->performerTaskDelegate->contains($performerTaskDelegate)) {
            $this->performerTaskDelegate[] = $performerTaskDelegate;
            $performerTaskDelegate->setDeligateBy($this);
        }

        return $this;
    }

    public function removePerformerTaskDelegate(PerformerTask $performerTaskDelegate): self
    {
        if ($this->performerTaskDelegate->removeElement($performerTaskDelegate)) {
            // set the owning side to null (unless already changed)
            if ($performerTaskDelegate->getDeligateBy() === $this) {
                $performerTaskDelegate->setDeligateBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TaskAssign[]
     */
    public function getTaskAssignsDelegate(): Collection
    {
        return $this->taskAssignsDelegate;
    }

    public function addTaskAssignsDelegate(TaskAssign $taskAssignsDelegate): self
    {
        if (!$this->taskAssignsDelegate->contains($taskAssignsDelegate)) {
            $this->taskAssignsDelegate[] = $taskAssignsDelegate;
            $taskAssignsDelegate->setDelegate($this);
        }

        return $this;
    }

    public function removeTaskAssignsDelegate(TaskAssign $taskAssignsDelegate): self
    {
        if ($this->taskAssignsDelegate->removeElement($taskAssignsDelegate)) {
            // set the owning side to null (unless already changed)
            if ($taskAssignsDelegate->getDelegate() === $this) {
                $taskAssignsDelegate->setDelegate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->setEvaluateUser($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getEvaluateUser() === $this) {
                $evaluation->setEvaluateUser(null);
            }
        }

        return $this;
    }

    public function getStaffType(): ?StaffType
    {
        return $this->staffType;
    }

    public function setStaffType(?StaffType $staffType): self
    {
        $this->staffType = $staffType;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getAlternativeEmail(): ?string
    {
        return $this->alternativeEmail;
    }

    public function setAlternativeEmail(?string $alternativeEmail): self
    {
        $this->alternativeEmail = $alternativeEmail;

        return $this;
    }

    

               

  
    

}
