<?php

declare(strict_types=1);

use app\core\Model;
use app\interfaces\IDataProvider;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    public function testAll(): void
    {
        $dataProviderMock = $this->createMock(IDataProvider::class);

        $this->assertInstanceOf(IDataProvider::class, $dataProviderMock);

        $dataProviderMock->expects($this->once())
            ->method('all')
            ->willReturn([
                [
                    'id' => '1',
                    'name'   => 'first',
                    'email'  => 'email@wxample.com',
                    'gender' => 'male',
                    'status' => 'active'
                ],
                [
                    'id' => '2',
                    'name'   => 'second',
                    'email'  => 'email@example.com',
                    'gender' => 'female',
                    'status' => 'active'
                ],
            ]);

        $model = new Model($dataProviderMock);

        $users = $model->all();

        $this->assertEquals([
            [
                'id' => '1',
                'name'   => 'first',
                'email'  => 'email@wxample.com',
                'gender' => 'male',
                'status' => 'active'
            ],
            [
                'id' => '2',
                'name'   => 'second',
                'email'  => 'email@example.com',
                'gender' => 'female',
                'status' => 'active'
            ],
        ], $users);
    }

    public function testFirst(): void
    {
        $dataProviderMock = $this->createMock(IDataProvider::class);

        $this->assertInstanceOf(IDataProvider::class, $dataProviderMock);

        $dataProviderMock->expects($this->once())
            ->method('first')
            ->with('1')
            ->willReturn([
                'id' => '1',
                'name'   => 'first',
                'email'  => 'email@wxample.com',
                'gender' => 'male',
                'status' => 'active'
            ]);

        $model = new Model($dataProviderMock);

        $result = $model->first('1');

        $this->assertEquals([
            'id' => '1',
            'name'   => 'first',
            'email'  => 'email@wxample.com',
            'gender' => 'male',
            'status' => 'active'
        ], $result);
    }

    public function testCreate(): void
    {
        $dataProviderMock = $this->createMock(IDataProvider::class);

        $this->assertInstanceOf(IDataProvider::class, $dataProviderMock);

        $dataProviderMock->expects($this->once())
            ->method('create')
            ->with([
                'name'   => 'new',
                'email'  => 'newemail@example.com',
                'gender' => 'male',
                'status' => 'active'
            ])
            ->willReturn(true);

        $model = new Model($dataProviderMock);

        $result = $model->create([
            'name'   => 'new',
            'email'  => 'newemail@example.com',
            'gender' => 'male',
            'status' => 'active'
        ]);

        $this->assertTrue($result);
    }

    public function testUpdate(): void
    {
        $dataProviderMock = $this->createMock(IDataProvider::class);

        $this->assertInstanceOf(IDataProvider::class, $dataProviderMock);

        $dataProviderMock->expects($this->once())
            ->method('update')
            ->with([
                'name'   => 'new',
                'email'  => 'newemail@example.com',
                'gender' => 'male',
                'status' => 'active'
            ], '2')
            ->willReturn(true);

        $model = new Model($dataProviderMock);

        $result = $model->update([
            'name'   => 'new',
            'email'  => 'newemail@example.com',
            'gender' => 'male',
            'status' => 'active'
        ], '2');

        $this->assertTrue($result);
    }

    public function testDelete(): void
    {
        $dataProviderMock = $this->createMock(IDataProvider::class);

        $this->assertInstanceOf(IDataProvider::class, $dataProviderMock);

        $dataProviderMock->expects($this->once())
            ->method('delete')
            ->with('2')
            ->willReturn(true);

        $model = new Model($dataProviderMock);

        $result = $model->delete('2');

        $this->assertTrue($result);
    }

}
