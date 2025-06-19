import { Injectable, NotFoundException } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository, Between } from 'typeorm';
import { Booking } from './booking.entity';
import { CreateBookingInput } from './dto/create-booking.input';
import { HotelService } from '../hotel/hotel.service';

@Injectable()
export class BookingService {
  constructor(
    @InjectRepository(Booking)
    private bookingRepository: Repository<Booking>,
    private hotelService: HotelService,
  ) {}

  async create(createBookingInput: CreateBookingInput): Promise<Booking> {
    const hotel = await this.hotelService.findOne(createBookingInput.hotel_id);
    const booking = this.bookingRepository.create({
      ...createBookingInput,
      hotel,
    });
    return this.bookingRepository.save(booking);
  }

  async cancel(id: number): Promise<boolean> {
    const result = await this.bookingRepository.delete(id);
    return (result.affected ?? 0) > 0;
  }

    async checkIn(id: number): Promise<Booking> {
    const booking = await this.bookingRepository.findOne({
        where: { id },
    });
    if (!booking) {
        throw new NotFoundException(`Booking with ID ${id} not found`);
    }
    booking.is_checked_in = true;
    return this.bookingRepository.save(booking);
    }

  async findByDateRange(start_date: Date, end_date: Date): Promise<Booking[]> {
    return this.bookingRepository.find({
      where: {
        start_date: Between(start_date, end_date),
      },
      relations: ['hotel'],
    });
  }
}