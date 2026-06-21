<?php

namespace App\Providers;

use App\Interfaces\AboutRepositoryInterface;
use App\Interfaces\AdminRepositoryInterface;
use App\Interfaces\ArticleRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\CompanyRepositoryInterface;
use App\Interfaces\ContactPeopleRepositoryInterface;
use App\Interfaces\ContactUsRepositoryInterface;
use App\Interfaces\CountryRepositoryInterface;
use App\Interfaces\EmailTemplateRepositoryInterface;
use App\Interfaces\EventRepositoryInterface;
use App\Interfaces\ExpoCompanyRepositoryInterface;
use App\Interfaces\ExpoRepositoryInterface;
use App\Interfaces\FaqRepositoryInterface;
use App\Interfaces\guideLineRepositoryInterface;
use App\Interfaces\JobRepositoryInterface;
use App\Interfaces\KnewsLettersRepositoryInterface;
use App\Interfaces\LogoCompanyRepositoryInterface;
use App\Interfaces\MenuItemRepositoryInterface;
use App\Interfaces\MenuRepositoryInterface;
use App\Interfaces\NewsletterRepositoryInterface;
use App\Interfaces\PackageRepositoryInterface;
use App\Interfaces\PageContactUsRepositoryInterface;
use App\Interfaces\PageRepositoryInterface;
use App\Interfaces\PageSectionRepositoryInterface;
use App\Interfaces\PartnerRepositoryInterface;
use App\Interfaces\PermissionRepositoryInterface;
use App\Interfaces\PolicyRepositoryInterface;
use App\Interfaces\RefRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\ServiceRepositoryInterface;
use App\Interfaces\SettingRepositoryInterface;
use App\Interfaces\SliderRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;
use App\Interfaces\TermsConditionInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\VisitRepositoryInterface;
use App\Repositories\AboutRepository;
use App\Repositories\AdminRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\CityRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\ContactPeopleRepository;
use App\Repositories\ContactUsRepository;
use App\Repositories\CountryRepository;
use App\Repositories\EmailTemplateRepository;
use App\Repositories\EventRepository;
use App\Repositories\ExpoCompanyRepository;
use App\Repositories\ExpoRepository;
use App\Repositories\FaqRepository;
use App\Repositories\guideLineRepository;
use App\Repositories\JobRepository;
use App\Repositories\KnewsLettersRepository;
use App\Repositories\LogoCompanyRepository;
use App\Repositories\MenuItemRepository;
use App\Repositories\MenuRepository;
use App\Repositories\NewsletterRepository;
use App\Repositories\PackageRepository;
use App\Repositories\PageContactUsRepository;
use App\Repositories\PageRepository;
use App\Repositories\PageSectionRepository;
use App\Repositories\PartnerRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\PolicyRepository;
use App\Repositories\RefRepository;
use App\Repositories\RoleRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\SettingRepository;
use App\Repositories\SliderRepository;
use App\Repositories\TeamRepository;
use App\Repositories\TermsConditionRepository;
use App\Repositories\UserRepository;
use App\Repositories\VisitRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(PageSectionRepositoryInterface::class, PageSectionRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
        $this->app->bind(MenuItemRepositoryInterface::class, MenuItemRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(JobRepositoryInterface::class, JobRepository::class);
        $this->app->bind(FaqRepositoryInterface::class, FaqRepository::class);
        $this->app->bind(AboutRepositoryInterface::class, AboutRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ContactUsRepositoryInterface::class, ContactUsRepository::class);
        $this->app->bind(KnewsLettersRepositoryInterface::class, KnewsLettersRepository::class);
        $this->app->bind(PolicyRepositoryInterface::class, PolicyRepository::class);
        $this->app->bind(TermsConditionInterface::class, TermsConditionRepository::class);
        $this->app->bind(PartnerRepositoryInterface::class, PartnerRepository::class);
        $this->app->bind(VisitRepositoryInterface::class, VisitRepository::class);
        $this->app->bind(RefRepositoryInterface::class, RefRepository::class);
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(guideLineRepositoryInterface::class, guideLineRepository::class);
        $this->app->bind(PageContactUsRepositoryInterface::class, PageContactUsRepository::class);
        $this->app->bind(SliderRepositoryInterface::class, SliderRepository::class);
        $this->app->bind(LogoCompanyRepositoryInterface::class, LogoCompanyRepository::class);
        $this->app->bind(PackageRepositoryInterface::class, PackageRepository::class);
        $this->app->bind(ExpoRepositoryInterface::class, ExpoRepository::class);
        $this->app->bind(ExpoCompanyRepositoryInterface::class, ExpoCompanyRepository::class);
        $this->app->bind(NewsletterRepositoryInterface::class, NewsletterRepository::class);
        $this->app->bind(JobRepositoryInterface::class, JobRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

