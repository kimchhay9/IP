import { Module } from '@nestjs/common';
import { TypeOrmModule } from '@nestjs/typeorm';
import { Booking } from './booking.entity';
import { BookingResolver } from './booking.resolver';
import { BookingService } from './booking.service';
import { HotelService } from '../hotel/hotel.service';
import { Hotel } from '../hotel/hotel.entity';

@Module({
  imports: [TypeOrmModule.forFeature([Booking, Hotel])],
  providers: [BookingResolver, BookingService, HotelService],
})
export class BookingModule {}