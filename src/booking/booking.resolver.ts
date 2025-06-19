import { Resolver, Mutation, Query, Args, Int } from '@nestjs/graphql';
import { BookingService } from './booking.service';
import { BookingType } from './booking.type';
import { CreateBookingInput } from './dto/create-booking.input';

@Resolver(() => BookingType)
export class BookingResolver {
  constructor(private bookingService: BookingService) {}

  @Mutation(() => BookingType)
  async bookHotel(
    @Args('createBookingInput') createBookingInput: CreateBookingInput,
  ) {
    return this.bookingService.create(createBookingInput);
  }

  @Mutation(() => Boolean)
  async cancelBooking(@Args('id', { type: () => Int }) id: number) {
    return this.bookingService.cancel(id);
  }

  @Mutation(() => BookingType)
  async checkIn(@Args('id', { type: () => Int }) id: number) {
    return this.bookingService.checkIn(id);
  }

  @Query(() => [BookingType])
  async bookingsByDateRange1(
    @Args('start_date') start_date: Date,
    @Args('end_date') end_date: Date,
  ) {
      return this.bookingService.findByDateRange(start_date, end_date);
    }
}