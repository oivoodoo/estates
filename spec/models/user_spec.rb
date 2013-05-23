require 'spec_helper'

describe User do
  it { should have_many(:authentications) }
  it { should validate_presence_of(:name) }
  it { should validate_presence_of(:email) }
end

describe User do
  describe '#role?' do
    describe '#admin' do
      let(:admin) { create(:admin) }

      it 'should be admin' do
        expect(admin.role?(:admin)).to be_true
      end
    end

    context '#user' do
      let(:user) { create(:user) }

      it 'should be normal user' do
        expect(user.role?(:admin)).to be_false
      end
    end
  end
end

describe User do
  context '#admin' do
    let(:admin) { create(:admin) }

    subject { Ability.new(admin) }

    it { should be_able_to(:manage, :all) }
  end
end

describe User do
  describe '#find_for_facebook' do
    context 'with valid auth' do
      before do
        @auth  = double('auth', provider: 'facebook', uid: 'facebook-id', extra: { 'raw_info' => { 'name' => 'John Watson' } }, info: { 'email' => 'john.watson@example.com' })
        @user  = User.find_for_facebook(@auth)
      end

      it 'should create a new user by facebook auth' do
        expect(User.count).to  eq(1)
        expect(@user.name).to  eq("John Watson")
        expect(@user.email).to eq("john.watson@example.com")
      end

      it 'should create facebook authentication' do
        authentications = @user.reload.authentications
        expect(authentications).to have(1).item
        expect(authentications[0].provider).to eq('facebook')
        expect(authentications[0].uid).to      eq('facebook-id')
      end
    end

    context 'with invalid auth' do
      before do
        @auth  = double('auth', provider: 'facebook', uid: 'uid', extra: { 'raw_info' => { 'name' => '' } }, info: { 'email' => '' })
        @user  = User.find_for_facebook(@auth)
      end

      it 'should not create a new user' do
        expect(User.count).to eq(0)
      end

      it 'should not create a authentication' do
        expect(Authentication.count).to eq(0)
      end
    end
  end

  describe '#find_for_google' do
    context 'with valid auth' do
      before do
        @auth = double('auth', provider: 'google', uid: 'google-id', info: { 'email' => 'john.watson@example.com', 'name' => 'John Watson' })
        @user = User.find_for_google(@auth)
      end

      it 'should create a new user by facebook auth' do
        expect(User.count).to  eq(1)
        expect(@user.name).to  eq("John Watson")
        expect(@user.email).to eq("john.watson@example.com")
      end

      it 'should create facebook authentication' do
        authentications = @user.reload.authentications
        expect(authentications).to have(1).item
        expect(authentications[0].provider).to eq('google')
        expect(authentications[0].uid).to      eq('google-id')
      end
    end

    context 'with invalid auth' do
      before do
        @auth = double('auth', provider: 'google', uid: 'uid', info: { 'email' => '', 'name' => 'John Watson' })
        @user = User.find_for_google(@auth)
      end

      it 'should not create a new user' do
        expect(User.count).to eq(0)
      end

      it 'should not create a authentication' do
        expect(Authentication.count).to eq(0)
      end
    end
  end

  context 'with multiple authentication methods' do
    let!(:kate_google)   { create(:authentication, email: 'kate@example.com', provider: 'google', uid: 'google-id') }
    let!(:kate_facebook) { create(:authentication, email: 'kate@example.com', provider: 'facebook', uid: 'facebook-id') }
    let(:google)   { double('auth', provider: 'google', uid: 'google-id', info: { 'email' => 'kate@example.com' }) }
    let(:facebook) { double('auth', provider: 'facebook', uid: 'facebook-id', info: { 'email' => 'kate@example.com' }, extra: { 'raw_info' => { 'name' => 'John Watson' } }) }

    it 'should be possible to login using email and provider details' do
      user = User.find_for_google(google)
      expect(user).to eq(kate_google.user)
      user = User.find_for_facebook(facebook)
      expect(user).to eq(kate_facebook.user)
    end
  end
end

