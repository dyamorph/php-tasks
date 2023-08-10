<?php

declare(strict_types=1);

use app\interfaces\IDataProvider;
use app\providers\ApiProvider;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    private IDataProvider $apiProvider;

    public function setUp(): void
    {
        $this->apiProvider = new ApiProvider();
    }

    public function testGetAll()
    {
        $mockUsers = [
            [
                "id" => 4316555,
                "name" => "Leha Banan",
                "email" => "banan@mail.com",
                "gender" => "male",
                "status" => "active"
            ],
            [
                "id" => 4316207,
                "name" => "Akroor Gandhi",
                "email" => "gandhi_akroor@hessel.example",
                "gender" => "male",
                "status" => "active"
            ],
            [
                "id" => 4316206,
                "name" => "Manjusha Bandopadhyay DC",
                "email" => "dc_manjusha_bandopadhyay@fritsch.test",
                "gender" => "male",
                "status" => "inactive"
            ],
            [
                "id" => 4316205,
                "name" => "Opaline Menon",
                "email" => "menon_opaline@hermann.test",
                "gender" => "female",
                "status" => "inactive"
            ],
            [
                "id" => 4316204,
                "name" => "Bankim Mehra II",
                "email" => "bankim_ii_mehra@walter.example",
                "gender" => "male",
                "status" => "active"
            ],
            [
                "id" => 4316203,
                "name" => "Avadhesh Kakkar",
                "email" => "kakkar_avadhesh@turner.example",
                "gender" => "male",
                "status" => "inactive"
            ],
            [
                "id" => 4316202,
                "name" => "The Hon. Shrishti Shukla",
                "email" => "the_shrishti_shukla_hon@powlowski.example",
                "gender" => "male",
                "status" => "inactive"
            ],
            [
                "id" => 4316200,
                "name" => "Chaturaanan Gowda",
                "email" => "gowda_chaturaanan@yost.test",
                "gender" => "male",
                "status" => "inactive"
            ],
            [
                "id" => 4316199,
                "name" => "Dr. Sanjay Kakkar",
                "email" => "sanjay_dr_kakkar@kling.test",
                "gender" => "female",
                "status" => "active"
            ],
            [
                "id" => 4316198,
                "name" => "Sukanya Somayaji",
                "email" => "somayaji_sukanya@schaden-wiza.test",
                "gender" => "female",
                "status" => "inactive"
            ]
        ];

        $users = $this->apiProvider->all();

        $this->assertEquals($mockUsers, $users);
    }

    public function testGetFirst()
    {
        $mockUser = [
            "id" => 4316198,
            "name" => "Sukanya Somayaji",
            "email" => "somayaji_sukanya@schaden-wiza.test",
            "gender" => "female",
            "status" => "inactive"
        ];

        $user = $this->apiProvider->first('4316198');

        $this->assertEquals($mockUser, $user);
    }

    public function testGetWithLimit()
    {
        $mockUsers = [
            [
                "id" => 4316194,
                "name" => "Sushma Chaturvedi",
                "email" => "chaturvedi_sushma@erdman-beahan.example",
                "gender" => "male",
                "status" => "active"
            ],
            [
                "id" => 4316193,
                "name" => "Fr. Udit Khan",
                "email" => "khan_udit_fr@konopelski.example",
                "gender" => "male",
                "status" => "inactive"
            ],
            [
                "id" => 4316192,
                "name" => "Charuchandra Guha Jr.",
                "email" => "guha_jr_charuchandra@cole.example",
                "gender" => "male",
                "status" => "active"
            ],
            [
                "id" => 4316191,
                "name" => "Naveen Mishra PhD",
                "email" => "mishra_phd_naveen@waelchi.example",
                "gender" => "female",
                "status" => "inactive"
            ],
            [
                "id" => 4316190,
                "name" => "Agastya Singh",
                "email" => "singh_agastya@schaefer-schulist.example",
                "gender" => "female",
                "status" => "active"
            ]
        ];

        $users = $this->apiProvider->withLimit(2, 5);

        $this->assertEquals($mockUsers, $users);
    }

    public function testCreate()
    {
        $mockUser = [
            "name" => "kabanov kabanov",
            "email" => "kabanob@dkasld.com",
            "gender" => "male",
            "status" => "active"
        ];

        $createdUser = json_decode($this->apiProvider->create($mockUser), true);

        $this->assertEmpty(array_diff($mockUser, $createdUser));
    }

    public function testUpdate()
    {
        $mockUser = [
            "name" => "jora pivas",
            "email" => "jora@dkasld.com",
            "gender" => "male",
            "status" => "inactive"
        ];

        $updatedUser = json_decode($this->apiProvider->update($mockUser, '4339426'), true);
        $mockUser['id'] = '4339426';

        $this->assertEquals($updatedUser, $mockUser);
    }

    public function testDelete()
    {
        $this->assertEquals('', $this->apiProvider->delete('4339280'));
    }
}