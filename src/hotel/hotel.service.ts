import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { Hotel } from './hotel.entity';
import { CreateHotelInput } from './dto/create-hotel.input';
import { UpdateHotelInput } from './dto/update-hotel.input';

@Injectable()
export class HotelService {
  constructor(
    @InjectRepository(Hotel)
    private hotelRepository: Repository<Hotel>,
  ) {}

  async create(createHotelInput: CreateHotelInput): Promise<Hotel> {
    const hotel = this.hotelRepository.create(createHotelInput);
    return this.hotelRepository.save(hotel);
  }

  async update(updateHotelInput: UpdateHotelInput): Promise<Hotel> {
    const hotel = await this.hotelRepository.findOneOrFail({
      where: { id: updateHotelInput.id },
    });
    Object.assign(hotel, updateHotelInput);
    return this.hotelRepository.save(hotel);
  }

  async delete(id: number): Promise<boolean> {
    const result = await this.hotelRepository.delete(id);
    return (result.affected ?? 0) > 0;
  }

  async findOne(id: number): Promise<Hotel> {
    return this.hotelRepository.findOneOrFail({
      where: { id },
      relations: ['bookings'],
    });
  }

  async findAll(): Promise<Hotel[]> {
    return this.hotelRepository.find({ relations: ['bookings'] });
  }
}