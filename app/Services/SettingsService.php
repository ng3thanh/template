<?php

namespace App\Services;

use App\Repositories\Footers\FootersRepositoryInterface;
use App\Repositories\Introduces\IntroducesRepositoryInterface;
use App\Repositories\IntroducesTranslate\IntroducesTranslateRepositoryInterface;
use App\Repositories\Logo\LogoRepositoryInterface;
use App\Repositories\Slides\SlidesRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class SettingsService
{
    /**
     * @var SlidesRepositoryInterface
     */
    protected $slidesRepository;

    /**
     * @var FootersRepositoryInterface
     */
    protected $footersRepository;

    /**
     * @var IntroducesRepositoryInterface
     */
    protected $introducesRepository;

    /**
     * @var IntroducesTranslateRepositoryInterface
     */
    protected $introducesTranslateRepository;

    /**
     * @var LogoRepositoryInterface
     */
    protected $logoRepository;

    /**
     * SettingsService constructor.
     * @param SlidesRepositoryInterface $slidesRepository
     * @param FootersRepositoryInterface $footersRepository
     * @param IntroducesRepositoryInterface $introducesRepository
     * @param IntroducesTranslateRepositoryInterface $introducesTranslateRepository
     * @param LogoRepositoryInterface $logoRepository
     */
    public function __construct(
        SlidesRepositoryInterface $slidesRepository,
        FootersRepositoryInterface $footersRepository,
        IntroducesRepositoryInterface $introducesRepository,
        IntroducesTranslateRepositoryInterface $introducesTranslateRepository,
        LogoRepositoryInterface $logoRepository
    ) {
        $this->slidesRepository = $slidesRepository;
        $this->footersRepository = $footersRepository;
        $this->introducesRepository = $introducesRepository;
        $this->introducesTranslateRepository = $introducesTranslateRepository;
        $this->logoRepository = $logoRepository;
    }

    /**
     * Get slide showing (only one)
     * @return mixed
     */
    public function getSlideShowing()
    {
        $data = $this->slidesRepository->getDataOrderBy('updated_at')->first();
        return $data;
    }

    /**
     * Get 4 slide not show
     *
     * @return mixed
     */
    public function getSlideNotShow($limit)
    {
        $data = $this->slidesRepository->getSlideNotShow($limit)->get();
        return $data;
    }

    /**
     * Create new slide
     *
     * @param $data
     * @return bool
     */
    public function createSlide($data)
    {
        try {
            DB::beginTransaction();

            $this->deleteAllSlideShow();

            if (isset($data['image'])) {
                $file = $data['image'];
                unset($data['image']);
            }
            $result = $this->slidesRepository->create($data);
            if ($result) {
                $newName = uploadImage($result->id, $file, 'slide');
                $this->slidesRepository->update(
                    $result->id,
                    ['image' => config('upload.slide') . $result->id . '/' . $newName]
                );
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    /**
     * Delete all slide show before create new or change slide show
     */
    private function deleteAllSlideShow()
    {
        $slides = $this->slidesRepository->getAll();
        foreach ($slides as $slide) {
            $this->slidesRepository->delete($slide->id);
        }
    }

    /**
     * Choosing slide to show
     *
     * @param $id
     * @return bool
     */
    public function chooseSlide($id)
    {
        try {
            DB::beginTransaction();

            $this->deleteAllSlideShow();
            $slide = $this->slidesRepository->findWithTrash($id);
            $slide->restore();

            DB::commit();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    /**
     * Get footer info
     *
     * @return mixed
     */
    public function getFooterInfo()
    {
        $data = $this->footersRepository->getAll()->groupBy('type');
        return $data;
    }

    /**
     * Update footer settings
     *
     * @param $data
     * @return bool
     */
    public function updateFooterSetting($data)
    {
        try {
            DB::beginTransaction();

            foreach ($data as $key => $value) {
                $id = $value['id'];
                unset($value['id']);
                $this->footersRepository->update($id, $value);
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    /**
     * Add new footer settings
     *
     * @param $data
     * @return bool
     */
    public function addNewFooterSetting($data)
    {
        try {
            DB::beginTransaction();
            $this->footersRepository->create($data);
            DB::commit();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function deleteFooter($id)
    {
        $delete = $this->footersRepository->delete($id);
        return $delete;
    }

    /**
     * Get introduce
     *
     * @return mixed
     */
    public function getIntroduce()
    {
        $introduce = $this->introducesRepository->getAll()->first();
        return $introduce;
    }

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateIntroduce($id, $data)
    {
        try {
            DB::beginTransaction();

            if (isset($data['image'])) {
                $newName = uploadImage($id, $data['image'], 'introduce');
                $data['image'] = config('upload.introduce') . $id . '/' . $newName;
            }

            $dataBaseIntroduce = formatDataBaseOnTable('introduces', $data);
            $this->introducesRepository->update($id, $dataBaseIntroduce);
            $dataTranslates = $data['trans'];
            foreach ($dataTranslates as $key => $value) {
                $this->introducesTranslateRepository->updateTrans('introduce_id', $id, $key, $value);
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function getLogo()
    {
        $logo = $this->logoRepository->getAll()->first();
        return $logo;
    }

    public function updateLogo($data)
    {
        try {
            DB::beginTransaction();

            if (isset($data['image'])) {
                $newName = uploadImage('logo', $data['image'], 'logo');
                $data['image'] = config('upload.logo') . 'logo/' . $newName;
            }

            if (isset($data['favicon'])) {
                $newName = uploadImage('favicon', $data['favicon'], 'logo');
                $data['favicon'] = config('upload.logo') . 'favicon/' . $newName;
            }

            $dataBaseIntroduce = formatDataBaseOnTable('logo', $data);
            $this->logoRepository->update(1, $dataBaseIntroduce);

            DB::commit();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }
}