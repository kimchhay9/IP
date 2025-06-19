import { Resolver, Query, Mutation, Args, Int } from '@nestjs/graphql';
import { HotelService } from './hotel.service';
import { HotelType } from './hotel.type';
import { CreateHotelInput } from './dto/create-hotel.input';
import { UpdateHotelInput } from './dto/update-hotel.input';

@Resolver(() => HotelType)
export class HotelResolver {
  constructor(private hotelService: HotelService) {}

  @Mutation(() => HotelType)
  async createHotel(
    @Args('createHotelInput') createHotelInput: CreateHotelInput,
  ) {
    return this.hotelService.create(createHotelInput);
  }

  @Mutation(() => HotelType)
  async updateHotel(
    @Args('updateHotelInput') updateHotelInput: UpdateHotelInput,
  ) {
    return this.hotelService.update(updateHotelInput);
  }

  @Mutation(() => Boolean)
  async deleteHotel(@Args('id', { type: () => Int }) id: number) {
    return this.hotelService.delete(id);
  }

 @Query(() => [HotelType])
async hotels(@Args('id', { type: () => Int, nullable: true }) id?: number) {
  if (id) {
    const hotel = await this.hotelService.findOne(id);
    return hotel ? [hotel] : [];
  }
  return this.hotelService.findAll();
}
}